<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Make sure RoleSeeder runs first
        $this->call([
            UserSeeder::class,
        ]);

        \App\Models\User::factory(10)->create();
    }
}

\App\Models\Assessment::factory(10)->create();
User::factory(10)->create();
