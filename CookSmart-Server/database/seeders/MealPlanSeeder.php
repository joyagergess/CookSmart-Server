<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MealPlan;

class MealPlanSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 3; $i++) {
            MealPlan::create([
                'household_id' => 1,
                'week_start_date' => now()->startOfWeek()->subWeeks($i),
            ]);
        }
    }
}
