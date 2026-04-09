<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class FixUserRolesSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure admin
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
            ]
        );

        // Fix others to user
        User::where('email', '!=', 'admin@gmail.com')
            ->where('role', 'admin')
            ->update(['role' => 'user']);
    }
}

