<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@civictrack.com',
            'password' => Hash::make('password'),
            // 'location_lat' => 28.6139,
            // 'location_lng' => 77.2090,
        ]);

        User::create([
            'name' => 'Regular User',
            'email' => 'user@civictrack.com',
            'password' => Hash::make('password'),
            // 'location_lat' => 28.7041,
            // 'location_lng' => 77.1025,
        ]);
    }
}
