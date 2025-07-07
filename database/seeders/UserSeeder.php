<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create project manager
        User::create([
            'name' => 'Project Manager',
            'email' => 'manager@example.com',
            'password' => Hash::make('password'),
            'role' => 'project_manager',
        ]);

        // Create developers
        User::create([
            'name' => 'Developer 1',
            'email' => 'dev1@example.com',
            'password' => Hash::make('password'),
            'role' => 'developer',
        ]);

        User::create([
            'name' => 'Developer 2',
            'email' => 'dev2@example.com',
            'password' => Hash::make('password'),
            'role' => 'developer',
        ]);

        User::create([
            'name' => 'Developer 3',
            'email' => 'dev3@example.com',
            'password' => Hash::make('password'),
            'role' => 'developer',
        ]);
    }
}
