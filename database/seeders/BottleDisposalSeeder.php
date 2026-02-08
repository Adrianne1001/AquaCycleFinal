<?php

namespace Database\Seeders;

use App\Models\BottleDisposal;
use Illuminate\Database\Seeder;

class BottleDisposalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create bottle disposal records for testing
        BottleDisposal::factory(20)->create();
    }
}
