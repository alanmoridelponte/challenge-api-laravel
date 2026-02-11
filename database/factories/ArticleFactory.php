<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'content' => fake()->paragraphs(3, true),
            'slug' => fake()->slug(),
            'status' => fake()->randomElement(['draft', 'published']),
            'published_at' => fake()->dateTime(),
            'author_id' => User::factory(),
        ];
    }
}
