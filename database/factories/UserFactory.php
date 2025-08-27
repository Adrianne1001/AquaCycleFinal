<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'account_id' => $this->generateUniqueAccountId(),
            'name' => fake()->name(),
            'year_level' => 2,
            'id_number' => "516960",
            'email' => fake()->unique()->safeEmail(),
            'role' => "Student",
            'email_verified_at' => now(),
             'password' => bcrypt('admin123!'), 
            'remember_token' => Str::random(10),
            'status' => "Available"
        ];
    }
    protected function generateUniqueAccountId()
    {
        do {
            // Generate a random 6-digit number
            $accountId = mt_rand(100000, 999999);
        } while (User::where('account_id', $accountId)->exists()); // Ensure uniqueness

        return $accountId;
    }
    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
