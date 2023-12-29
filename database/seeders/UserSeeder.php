<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

        $owner = User::create([
            'name' => 'Jayusman',
            'email' => 'owner@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $owner->assignRole('owner');

        $manager_a = User::create([
            'name' => 'Admin',
            'email' => 'manager_a@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $manager_a->assignRole('manager');
        
        $manager_b = User::create([
            'name' => 'Admin',
            'email' => 'manager_b@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $manager_b->assignRole('manager');

        $manager_c = User::create([
            'name' => 'Admin',
            'email' => 'manager_c@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $manager_c->assignRole('manager');

        $manager_d = User::create([
            'name' => 'Admin',
            'email' => 'manager_d@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $manager_d->assignRole('manager');

        $manager_e = User::create([
            'name' => 'Admin',
            'email' => 'manager_e@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $manager_e->assignRole('manager');

        $kasir_a = User::create([
            'name' => 'Admin',
            'email' => 'kasir_a@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $kasir_a->assignRole('cashier');

        $kasir_b = User::create([
            'name' => 'Admin',
            'email' => 'kasir_b@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $kasir_b->assignRole('cashier');

        $kasir_c = User::create([
            'name' => 'Admin',
            'email' => 'kasir_c@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $kasir_c->assignRole('cashier');

        $kasir_d = User::create([
            'name' => 'Admin',
            'email' => 'kasir_d@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $kasir_d->assignRole('cashier');

        $kasir_e = User::create([
            'name' => 'Admin',
            'email' => 'kasir_e@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $kasir_e->assignRole('cashier');

        $warehouse_a = User::create([
            'name' => 'Admin',
            'email' => 'warehouse_a@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $warehouse_a->assignRole('warehouse-staff');

        $warehouse_b = User::create([
            'name' => 'Admin',
            'email' => 'warehouse_b@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $warehouse_b->assignRole('warehouse-staff');

        $warehouse_c = User::create([
            'name' => 'Admin',
            'email' => 'warehouse_c@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $warehouse_c->assignRole('warehouse-staff');

        $warehouse_d = User::create([
            'name' => 'Admin',
            'email' => 'warehouse_d@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $warehouse_d->assignRole('warehouse-staff');

        $warehouse_e = User::create([
            'name' => 'Admin',
            'email' => 'warehouse_e@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $warehouse_e->assignRole('warehouse-staff');

    }
}
