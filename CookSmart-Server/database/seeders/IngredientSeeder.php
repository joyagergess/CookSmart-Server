<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;

class IngredientSeeder extends Seeder
{
    public function run(): void
    {
        $ingredients = [
            'Tomato', 'Onion', 'Garlic', 'Rice', 'Potato',
            'Chicken Breast', 'Olive Oil', 'Lemon', 'Eggs', 'Milk'
        ];

        foreach ($ingredients as $ing) {
            Ingredient::create(['name' => $ing]);
        }
    }
}
