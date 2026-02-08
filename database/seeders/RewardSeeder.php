<?php

namespace Database\Seeders;

use App\Models\reward;
use Illuminate\Database\Seeder;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a water reward
        reward::factory(1)->create([
            'description' => "Water",
            'image_url' => "rewards/water.png",
            'avail_qty' => 999999999,
            'points_required' => 3,
            'status' => "Available"
        ]);

        // Create random rewards
        reward::factory(5)->create();
    }
}
