<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin user if it doesn't exist
        $existingAdmin = User::whereHas('admin')->first();

        if (!$existingAdmin) {
            // Create user
            $user = User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
            ]);

            // Create admin
            Admin::create([
                'user_id' => $user->id,
                'username' => 'admin',
            ]);

            $this->command->info('Default admin created: admin@example.com / password123');
        } else {
            $this->command->info('Admin already exists!');
        }
    }
}
