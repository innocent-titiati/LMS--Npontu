<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'first_name' => 'Admin1', 
            'last_name' => 'User1',
            'email' => 'admin1@example.com',
            'password' => Hash::make('password'),
            'role' => 'hr',
        ]);

        // Create 10 users with random roles
        User::factory(10)->create();
    }
}
