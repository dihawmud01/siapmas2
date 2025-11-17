<?php

namespace Database\Factories;

use App\Enums\LetterType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Letter>
 */
class LetterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Surat ' . $this->faker->sentence(1),
            'reference_number' => $this->faker->ean13(),
            'from' => $this->faker->name('male'),
            'to' => $this->faker->name('female'),
            'letter_date' => $this->faker->date(),
            'received_date' => $this->faker->date(),
            'description' => $this->faker->sentence(7),
            'note' => $this->faker->sentence(3),
            'type' => $this->faker->randomElement([LetterType::INCOMING->type(), LetterType::OUTGOING->type()]),
            'classification_code' => 'ADM',
            'user_id' => $this->faker->numberBetween(2, 33),
        ];
    }
}