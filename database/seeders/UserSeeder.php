<?php

namespace Database\Seeders;

use App\Models\User;
use App\Enums\Faculty;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create admin user
        User::factory(1)->create([
            'account_id' => $this->generateUniqueAccountId(),
            'name' => "Administrator",
            'year_level' => 4,
            'id_number' => "000000",
            'faculty' => Faculty::FaCET,
            'email' => "admin@admin.com",
            'role' => "Admin",
            'email_verified_at' => now(),
            'password' => bcrypt('admin123!'),
            'remember_token' => Str::random(10),
            'status' => "Available"
        ]);

        // Create regular student users
        User::factory(10)->create([
            'faculty' => fake()->randomElement(Faculty::cases()),
        ]);
    }

    /**
     * Generate a unique account ID.
     *
     * @return int
     */
    protected function generateUniqueAccountId()
    {
        do {
            $accountId = mt_rand(100000, 999999);
        } while (User::where('account_id', $accountId)->exists());

        return $accountId;
    }
}
