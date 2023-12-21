<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $admin->assignRole('admin');
    }
}
