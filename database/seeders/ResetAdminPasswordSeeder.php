<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetAdminPasswordSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@gmail.com')->first();
        if ($admin) {
            $admin->update([
                'password' => Hash::make('12345678'),
                'role' => 'admin',
            ]);
            echo "Admin password reset to '12345678'\n";
        } else {
            echo "Admin not found\n";
        }
    }
}

