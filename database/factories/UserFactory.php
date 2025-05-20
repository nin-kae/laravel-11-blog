<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

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
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'activated' => true,
            'password' => static::$password ??= Hash::make('123456'),
            'remember_token' => Str::random(10),
            'created_at' => $formattedDateTime,
            'updated_at' => $formattedDateTime,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
