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
            'title' => fake()->realText('25'),
            'intro' => fake()->realText('200'),
            'body' => fake()->realText('300'),
            'conclusion' => fake()->realText('150'),
            'reference' => fake()->unique()->url(),  
            'author' => fake()->name(), 
            'image_url' => fake()->imageUrl(640, 480, 'nature', true, 'plastic waste'),
        ];
    }

}
