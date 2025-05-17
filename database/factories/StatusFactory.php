<?php

namespace Database\Factories;

use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Status>
 */
class StatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // 生成过去三年内到现在的随机 DateTime 对象
        $randomDateTime = $this->faker->dateTimeBetween('-3 years', 'now');

        // 格式化为 'Y-m-d H:i:s' 字符串
        $formattedDateTime = $randomDateTime->format('Y-m-d H:i:s');

        return [
            'user_id' => User::inRandomOrder()->first()?->id,
            'content' => $this->faker->text(),
            'created_at' => $formattedDateTime,
            'updated_at' => $formattedDateTime,
        ];
    }
}
