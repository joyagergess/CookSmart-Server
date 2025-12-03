<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
   public function run(): void
{
    $this->call([
        UserTypeSeeder::class,
        UserSeeder::class,
        HouseholdSeeder::class,
        HouseholdMemberSeeder::class,
        IngredientSeeder::class,
        PantryItemSeeder::class,
        RecipeSeeder::class,
        RecipeIngredientSeeder::class,
        MealPlanSeeder::class,
        MealPlanEntrySeeder::class,
        ShoppingListSeeder::class,
        ShoppingListItemSeeder::class,
        ExpenseSeeder::class,
    ]);
}

}
