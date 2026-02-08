<?php

namespace Database\Seeders;

use App\Models\UserStats;
use Illuminate\Database\Seeder;

class UserStatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create user stats for each user
        UserStats::factory(1)->create([
            'user_id' => 1,
            'outstanding_points' => 0,
            'total_accu_points' => 0,
            'total_bottles_thrown' => 0
        ]);

        // Create stats for other users (user_id 2-11)
        for ($i = 2; $i <= 11; $i++) {
            UserStats::factory(1)->create([
                'user_id' => $i,
                'outstanding_points' => fake()->numberBetween(0, 500),
                'total_accu_points' => fake()->numberBetween(0, 1000),
                'total_bottles_thrown' => fake()->numberBetween(0, 100)
            ]);
        }
    }
}
