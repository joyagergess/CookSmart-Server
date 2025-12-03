<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Household;
use Illuminate\Support\Str;

class HouseholdSeeder extends Seeder
{
    public function run(): void
    {
        Household::create([
            'name' => 'Gergess Family',
            'invite_code' => 'Gergess',
        ]);
    }
}
