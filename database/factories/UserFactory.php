<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'photo' => 'default.png',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(60),
            'check' => $this->faker->boolean(),
            'role_id' => $this->faker->numberBetween(1, 4),
            'bio' => $this->faker->text(),
            'username' => $this->faker->unique()->username(),
            'slug' => $this->faker->unique()->slug(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(
            fn (array $attributes) => [
                'email_verified_at' => null,
            ],
        );
    }
}
