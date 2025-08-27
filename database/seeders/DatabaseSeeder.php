<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create([
            'account_id' => $this->generateUniqueAccountId(),
            'name' => "Administrator",
            'year_level' => 4,
            'id_number' => "000000",
            'email' => "admin@admin.com",
            'role' => "Admin",
            'email_verified_at' => now(),
             'password' => bcrypt('admin123!'), 
            'remember_token' => Str::random(10),
            'status' => "Available"            
        ]);
        
        // \App\Models\User::factory(1)->create([
        //     'account_id' => $this->generateUniqueAccountId(),
        //     'name' => "Mc Kelvin John Bernal",
        //     'year_level' => 4,
        //     'id_number' => "234567",
        //     'email' => "user@user.com",
        //     'role' => "Student",
        //     'email_verified_at' => now(),
        //      'password' => bcrypt('admin123!'), 
        //     'remember_token' => Str::random(10),
        //     'status' => "Available"            
        // ]);
        \App\Models\reward::factory(1)->create([            
            'description' => "Water",
            'image_url' => "rewards/water.png",
            'avail_qty' => 999999999,
            'points_required' => 3,
            'status' => "Available"          
        ]);
        // \App\Models\User::factory(10)->create();
        // \App\Models\reward::factory(10)->create();
        // \App\Models\article::factory(10)->create();
        // \App\Models\RewardExchange::factory(10)->create();
        \App\Models\UserStats::factory(1)->create();
        // \App\Models\BottleDisposal::factory(20)->create();


        // \App\Models\RewardExchange::factory(5)->create([
        //     'user_id' => 1,
        //     'reward_id' => 1,
        //     'qty'=> fake() -> numberBetween(1,10),
        //     'status' => "Approved"            
        // ]);
        // \App\Models\RewardExchange::factory(5)->create([
        //     'user_id' => 1,
        //     'reward_id' => 1,
        //     'qty'=> fake() -> numberBetween(1,10),
        //     'status' => "Rejected"
        // ]);
        // \App\Models\RewardExchange::factory(5)->create([
        //     'user_id' => 1,
        //     'reward_id' => 1,
        //     'qty'=> fake() -> numberBetween(1,10),
        //     'status' => "Redeemed"
        // ]);
    }
    protected function generateUniqueAccountId()
    {
        do {
            $accountId = mt_rand(100000, 999999);
        } while (User::where('account_id', $accountId)->exists()); // Ensure uniqueness

        return $accountId;
    }
}
