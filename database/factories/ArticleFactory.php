<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(6),
            'intro' => fake()->paragraph(3),
            'body' => fake()->paragraph(5),
            'conclusion' => fake()->paragraph(2),
            'reference' => fake()->unique()->url(),  
            'author' => fake()->name(), 
            'image_url' => 'https://via.placeholder.com/640x480?text=' . fake()->word(),
        ];
    }

}
