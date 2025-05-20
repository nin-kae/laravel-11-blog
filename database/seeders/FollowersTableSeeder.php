<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $user = User::first();
        $userId = $user->id;

        // 获取去除掉用户 ID 为 1 的所有用户的 ID 的数组
        $followers = $users->slice(1);
        $followerIds = $followers->pluck('id')->toArray();

        // 用户 1 关注所有其他用户
        $user->follow($followerIds);

        // 除了用户 1 之外的所有用户都关注用户 1
        foreach ($followers as $follower) {
            $follower->follow($userId);
        }
    }
}
