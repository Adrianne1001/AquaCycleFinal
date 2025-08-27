<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\reward>
 */
class RewardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'description' => fake() -> words(),
            'image_url' => fake() -> imageUrl(),
            'avail_qty' => fake() -> numberBetween(30,50),
            'points_required' => fake() -> numberBetween(40,60),
            'status' => "Available"
        ];
    }
}
