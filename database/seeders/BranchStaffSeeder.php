<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BranchStaff;

class BranchStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $manageBranchA = BranchStaff::create([
            'branch_id' => '1',
            'user_id' => '3'
        ]);
        
        $manageBranchB = BranchStaff::create([
            'branch_id' => '2',
            'user_id' => '4'
        ]);
        
        $manageBranchC = BranchStaff::create([
            'branch_id' => '3',
            'user_id' => '5'
        ]);
        
        $manageBranchD = BranchStaff::create([
            'branch_id' => '4',
            'user_id' => '6'
        ]);
        
        $manageBranchE = BranchStaff::create([
            'branch_id' => '5',
            'user_id' => '7'
        ]);

    }
}
