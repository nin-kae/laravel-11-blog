<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;


/**
 *
 *
 * @property int $id
 * @property string $content The content of the status
 * @property int $user_id The ID of the user who created the status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User|null $user
 * @method static Builder<static>|Status newModelQuery()
 * @method static Builder<static>|Status newQuery()
 * @method static Builder<static>|Status query()
 * @method static Builder<static>|Status whereContent($value)
 * @method static Builder<static>|Status whereCreatedAt($value)
 * @method static Builder<static>|Status whereId($value)
 * @method static Builder<static>|Status whereUpdatedAt($value)
 * @method static Builder<static>|Status whereUserId($value)
 * @mixin Eloquent
 */
class Status extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['content'];

    /**
     * Status belongs to a user.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
