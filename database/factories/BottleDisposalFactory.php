<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BottleDisposal>
 */
class BottleDisposalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' =>2, 
            'points_received' => $this->faker->numberBetween(5, 50), 
            'bottles_qty' => $this->faker->numberBetween(1, 10), 
            'disposal_date' => fake()->dateTimeBetween($startdate='-2 months', $enddate= 'now'),
            'trashbag_fill_status' => "LOW",
            'small_qty' => 0,
            'med_qty' => 0,
            'large_qty' => 0,
            'xl_qty' => 0,
            'xxl_qty' => 0,
        ];
    }
}
