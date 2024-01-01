<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BrandStaff;


class BrandStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // manager
        $managerBranchA = BrandStaff::create([
            'brand_id' => '1',
            'user_id' => '3'
        ]);
        
        $managerBranchB = BrandStaff::create([
            'brand_id' => '1',
            'user_id' => '4'
        ]);
        
        $managerBranchC = BrandStaff::create([
            'brand_id' => '1',
            'user_id' => '5'
        ]);
        
        $managerBranchD = BrandStaff::create([
            'brand_id' => '1',
            'user_id' => '6'
        ]);
        
        $managerBranchE = BrandStaff::create([
            'brand_id' => '1',
            'user_id' => '7'
        ]);
        // kasir 
        $kasirBranchA = BrandStaff::create([
            'brand_id' => '1',
            'user_id' => '8'
        ]);
        $kasirBranchB = BrandStaff::create([
            'brand_id' => '1',
            'user_id' => '9'
        ]);
        $kasirBranchC = BrandStaff::create([
            'brand_id' => '1',
            'user_id' => '10'
        ]);
        $kasirBranchD = BrandStaff::create([
            'brand_id' => '1',
            'user_id' => '11'
        ]);
        $kasirBranchE = BrandStaff::create([
            'brand_id' => '1',
            'user_id' => '12'
        ]);
        // warehouse
        $warehouseBranchA = BrandStaff::create([
            'brand_id' => '1',
            'user_id' => '13'
        ]);
        $warehouseBranchB = BrandStaff::create([
            'brand_id' => '1',
            'user_id' => '14'
        ]);
        $warehouseBranchC = BrandStaff::create([
            'brand_id' => '1',
            'user_id' => '15'
        ]);
        $warehouseBranchD = BrandStaff::create([
            'brand_id' => '1',
            'user_id' => '16'
        ]);
        $warehouseBranchE = BrandStaff::create([
            'brand_id' => '1',
            'user_id' => '17'
        ]);
        // supervisor
        $supervisorBranchA = BrandStaff::create([
            'brand_id' => '1',
            'user_id' => '18'
        ]);
        $supervisorBranchB = BrandStaff::create([
            'brand_id' => '1',
            'user_id' => '19'
        ]);
        $supervisorBranchC = BrandStaff::create([
            'brand_id' => '1',
            'user_id' => '20'
        ]);
        $supervisorBranchD = BrandStaff::create([
            'brand_id' => '1',
            'user_id' => '21'
        ]);
        $supervisorBranchE = BrandStaff::create([
            'brand_id' => '1',
            'user_id' => '22'
        ]);
    }
}
