<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(mt_rand(5, 8));
        $slugBase = Str::slug($title);

        $slug = $slugBase . '-' . fake()->unique()->numberBetween(1000, 999999);

        return [
            'title' => $title,
            'slug' => $slug,
            'excerpt' => fake()->paragraph(mt_rand(2, 5)),
            'body' => collect(fake()->paragraphs(mt_rand(3, 7)))->implode("\n\n"),
            'is_published' => fake()->boolean(70),
            'published_at' => fake()->dateTimeBetween('-30 days', 'now'),
            'user_id' => null
        ];

    }
}