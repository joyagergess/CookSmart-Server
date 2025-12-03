<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RecipeIngredient;

class RecipeIngredientSeeder extends Seeder
{
    public function run(): void
    {
        for ($recipe = 1; $recipe <= 5; $recipe++) {
            for ($i = 0; $i < 3; $i++) {
                RecipeIngredient::create([
                    'recipe_id' => $recipe,
                    'ingredient_id' => rand(1, 10),
                    'amount' => rand(1, 3),
                    'unit' => 'pcs'
                ]);
            }
        }
    }
}
