<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\News;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<News>
 */
class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->text(),
            'slug' => $this->faker->slug,
            'content' => $this->faker->paragraph(8),
            'img' => $this->faker->imageUrl(850, 350),
            'active' => $this->faker->boolean,
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
        ];
    }
}
