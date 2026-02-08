<?php

namespace Database\Seeders;

use App\Models\RewardExchange;
use Illuminate\Database\Seeder;

class RewardExchangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create approved reward exchanges
        RewardExchange::factory(5)->create([
            'user_id' => 1,
            'reward_id' => 1,
            'qty' => fake()->numberBetween(1, 10),
            'status' => "Approved"
        ]);

        // Create rejected reward exchanges
        RewardExchange::factory(5)->create([
            'user_id' => 1,
            'reward_id' => 1,
            'qty' => fake()->numberBetween(1, 10),
            'status' => "Rejected"
        ]);

        // Create redeemed reward exchanges
        RewardExchange::factory(5)->create([
            'user_id' => 1,
            'reward_id' => 1,
            'qty' => fake()->numberBetween(1, 10),
            'status' => "Redeemed"
        ]);

        // Create pending reward exchanges
        RewardExchange::factory(10)->create();
    }
}
