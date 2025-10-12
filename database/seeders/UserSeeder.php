<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Administrator
        User::create([
            'name' => 'Administrator',
            'email' => 'administrator@example.com',
            'password' => Hash::make('password'), // ganti sesuai kebutuhan
            'role' => 'administrator',
        ]);

        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // ganti sesuai kebutuhan
            'role' => 'admin',
        ]);
    }
}
