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
     */
    public function run()
    {
        if (User::count() == 0) {

            User::create([
                'name'           => 'Admin',
                'email'          => 'prosperityestate@gmail.com',
                'password'       => bcrypt('Prosperityestate@2023'),
                'remember_token' => Str::random(60),
            ]);

            // Create the second user (silent)
            User::create([
                'name'           => 'Silent User',
                'email'          => 'silentuser@example.com',
                'password'       => bcrypt('SilentUserPassword'),
                'remember_token' => Str::random(60),
            ]);
        }
    }
}
