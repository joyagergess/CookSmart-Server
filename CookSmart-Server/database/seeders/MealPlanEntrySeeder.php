<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MealPlanEntry;

class MealPlanEntrySeeder extends Seeder
{
    public function run(): void
    {
        $mealTypes = ['breakfast', 'lunch', 'dinner'];

        for ($plan = 1; $plan <= 3; $plan++) {
            for ($i = 0; $i < 4; $i++) {
                MealPlanEntry::create([
                    'meal_plan_id' => $plan,
                    'day_of_week' => rand(1, 7),
                    'meal_type' => $mealTypes[array_rand($mealTypes)],
                    'recipe_id' => rand(1, 5),
                ]);
            }
        }
    }
}
