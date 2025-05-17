<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Random\RandomException;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws RandomException
     *
     */
    public function run(): void
    {
        // Create 708 - 923 random statuses
        \App\Models\Status::factory(random_int(708, 923))->create();
    }
}
