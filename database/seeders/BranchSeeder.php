<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Branch;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $JayusmanStoreBranchA = Branch::create([
            "brand_id" => "1",
            "owner_id" => "2",
            "name" => "JayusmanStoreBranchA",
            "Location" => "Cianjur, Cianjur"
        ]);
        
        $JayusmanStoreBranchB = Branch::create([
            "brand_id" => "1",
            "owner_id" => "2",
            "name" => "JayusmanStoreBranchB",
            "Location" => "Cipanas, Cianjur"
        ]);
        
        $JayusmanStoreBranchC = Branch::create([
            "brand_id" => "1",
            "owner_id" => "2",
            "name" => "JayusmanStoreBranchC",
            "Location" => "Agrabinta, Cianjur"
        ]);
        
        $JayusmanStoreBranchD = Branch::create([
            "brand_id" => "1",
            "owner_id" => "2",
            "name" => "JayusmanStoreBranchD",
            "Location" => "Cidaun, Cianjur"
        ]);
        
        $JayusmanStoreBranchE = Branch::create([
            "brand_id" => "1",
            "owner_id" => "2",
            "name" => "JayusmanStoreBranchE",
            "Location" => "Ciranjang, Cianjur"
        ]);
    }
}
