<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\DatabaseNotificationCollection;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read DatabaseNotificationCollection<int, DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static UserFactory factory($count = null, $state = [])
 * @method static Builder<static>|User newModelQuery()
 * @method static Builder<static>|User newQuery()
 * @method static Builder<static>|User query()
 * @method static Builder<static>|User whereCreatedAt($value)
 * @method static Builder<static>|User whereEmail($value)
 * @method static Builder<static>|User whereEmailVerifiedAt($value)
 * @method static Builder<static>|User whereId($value)
 * @method static Builder<static>|User whereName($value)
 * @method static Builder<static>|User wherePassword($value)
 * @method static Builder<static>|User whereRememberToken($value)
 * @method static Builder<static>|User whereUpdatedAt($value)
 * @property int $is_admin
 * @method static Builder<static>|User whereIsAdmin($value)
 * @property int $activated
 * @property string|null $activation_token
 * @method static Builder<static>|User whereActivated($value)
 * @method static Builder<static>|User whereActivationToken($value)
 * @property-read Collection<int, Status> $statuses
 * @property-read int|null $statuses_count
 * @property-read Collection<int, Status> $feed
 * @property-read int|null $feed_count
 * @property-read Collection<int, User> $followers
 * @property-read int|null $followers_count
 * @property-read Collection<int, User> $followings
 * @property-read int|null $followings_count
 * @mixin Eloquent
 */
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * 在创建用户的时候生成用户的 activation_token
     *
     * @return void
     */
    public static function boot(): void
    {
        parent::boot();

        static::creating(function (User $user) {
            // 生成激活令牌
            $user->activation_token = str()->random(30);
        });
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * 通过邮箱获取 gravatar.com 设置的头像
     *
     * @param string $size
     * @return string
     */
    public function gravatar(string $size = '100'): string
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "https://www.gravatar.com/avatar/$hash?s=$size";
    }

    /**
     * User has many status.
     *
     * @return Hasmany
     */
    public function statuses(): HasMany
    {
        return $this->hasMany(Status::class);
    }

    public function feed(): HasMany
    {
        return $this->statuses()->orderBy('created_at', 'desc');
    }

    /**
     * User has many followers.
     *
     * @return BelongsToMany
     */
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }

    /**
     * User has many followings.
     *
     * @return BelongsToMany
     */
    public function followings(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    /**
     * 关注用户
     *
     * @param $userIds
     * @return void
     */
    public function follow($userIds): void
    {
        // 这里需要注意的是, 我们在使用 sync() 方法之前要先有定义好对应的关系
        // sync(..., false) 只会添加新的记录，不会删除旧的记录
        $this->followings()->sync($userIds, false);
    }

    /**
     * 取消关注用户
     *
     * @param $userIds
     * @return void
     */
    public function unfollow($userIds): void
    {
        // 这里需要注意的是, 我们在使用 detach() 方法之前要先有定义好对应的关系
        // detach(ids) 删除指定的记录
        $this->followings()->detach($userIds);
    }

    /**
     * 判断当前用户是否关注了指定用户
     *
     * @param User int $userId
     * @return bool
     */
    public function isFollowing(int $userId): bool
    {
        // 使用 contains() 方法判断当前用户的关注列表中是否包含指定用户的 id
        return $this->followings->contains($userId);
    }

}
