<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        if (User::count() == 0) {

            User::create([
                'name'           => 'Admin',
                'email'          => 'prosperityrealestate@gmail.com',
                'password'       => bcrypt('Prosperity@2023'),
                'remember_token' => Str::random(60),
            ]);
        }
    }
}
