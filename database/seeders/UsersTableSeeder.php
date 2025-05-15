<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 生成 56 个用户数据
        User::factory()->count(56)->create();

        // 将用户 ID 为 1 的用户信息设置成我们自己的
        $user = User::find(1);
        $user->name = 'NIN-KAE';
        $user->email = 'renhuaying0401@gmail.com';
        $user->is_admin = true;
        $user->save();
    }
}
