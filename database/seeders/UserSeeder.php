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

        $manager_a = User::create([ //3
            'name' => 'Manager A',
            'email' => 'manager_a@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $manager_a->assignRole('manager');
        
        $manager_b = User::create([ //4
            'name' => 'Manager B',
            'email' => 'manager_b@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $manager_b->assignRole('manager');

        $manager_c = User::create([ //5
            'name' => 'Manager C',
            'email' => 'manager_c@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $manager_c->assignRole('manager');

        $manager_d = User::create([ //6
            'name' => 'Manager D',
            'email' => 'manager_d@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $manager_d->assignRole('manager');

        $manager_e = User::create([ //7
            'name' => 'Manager E',
            'email' => 'manager_e@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $manager_e->assignRole('manager');

        $kasir_a = User::create([ // 8
            'name' => 'Kasir A',
            'email' => 'kasir_a@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $kasir_a->assignRole('cashier');

        $kasir_b = User::create([ // 9 
            'name' => 'Kasir B',
            'email' => 'kasir_b@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $kasir_b->assignRole('cashier');

        $kasir_c = User::create([ // 10
            'name' => 'Kasir C',
            'email' => 'kasir_c@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $kasir_c->assignRole('cashier');

        $kasir_d = User::create([ // 11
            'name' => 'Kasir D',
            'email' => 'kasir_d@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $kasir_d->assignRole('cashier');

        $kasir_e = User::create([ // 12
            'name' => 'Kasir E',
            'email' => 'kasir_e@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $kasir_e->assignRole('cashier');

        $warehouse_a = User::create([ // 13
            'name' => 'staff gudang A',
            'email' => 'warehouse_a@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $warehouse_a->assignRole('warehouse-staff');

        $warehouse_b = User::create([ // 14
            'name' => 'staff gudang B',
            'email' => 'warehouse_b@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $warehouse_b->assignRole('warehouse-staff');

        $warehouse_c = User::create([ // 15
            'name' => 'staff gudang C',
            'email' => 'warehouse_c@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $warehouse_c->assignRole('warehouse-staff');

        $warehouse_d = User::create([ // 16
            'name' => 'staff gudang D',
            'email' => 'warehouse_d@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $warehouse_d->assignRole('warehouse-staff');

        $warehouse_e = User::create([ // 17
            'name' => 'staff gudang E',
            'email' => 'warehouse_e@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $warehouse_e->assignRole('warehouse-staff');

        $supervisor_a = User::create([ // 18
            'name' => 'Supervisor A',
            'email' => 'supervisor_a@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $supervisor_a->assignRole('supervisor');

        $supervisor_b = User::create([ // 19
            'name' => 'Supervisor B',
            'email' => 'supervisor_b@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $supervisor_b->assignRole('supervisor');

        $supervisor_c = User::create([ // 20
            'name' => 'Supervisor C',
            'email' => 'supervisor_c@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $supervisor_c->assignRole('supervisor');

        $supervisor_d = User::create([ // 21
            'name' => 'Supervisor D',
            'email' => 'supervisor_d@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $supervisor_d->assignRole('supervisor');

        $supervisor_e = User::create([ // 22
            'name' => 'Supervisor E',
            'email' => 'supervisor_e@kelontongs.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Password123'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $supervisor_e->assignRole('supervisor');

    }
}
