<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class CheckUsersRolesSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::select('email', 'role')->get();
        echo "Current users roles:\n";
        foreach ($users as $user) {
            echo "- {$user->email}: '{$user->role}'\n";
        }
    }
}

