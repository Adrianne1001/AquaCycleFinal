<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Call all seeders in the correct order
        $this->call([
            UserSeeder::class,
            RewardSeeder::class,
            ArticleSeeder::class,
            BottleDisposalSeeder::class,
            RewardExchangeSeeder::class,
            UserStatsSeeder::class,
        ]);
    }
}
