<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_admin = Role::create([
            'name' => 'admin'
        ]);

        $role_owner = Role::create([
            'name' => 'owner'
        ]);

        $role_manager = Role::create([
            'name' => 'manager'
        ]);

        $role_warehouse_staff = Role::create([
            'name' => 'warehouse-staff'
        ]);

        $role_cashier = Role::create([
            'name' => 'cashier'
        ]);
    }
}
