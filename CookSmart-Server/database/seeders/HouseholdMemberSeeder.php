<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HouseholdMember;

class HouseholdMemberSeeder extends Seeder
{
    public function run(): void
    {
        
        HouseholdMember::create([
            'household_id' => 1,
            'user_id' => 1,
        ]);

       
        HouseholdMember::create([
            'household_id' => 1,
            'user_id' => 2,
        ]);
    }
}
