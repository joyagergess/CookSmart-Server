<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;

class RecipeSeeder extends Seeder
{
    public function run(): void
    {
        $recipes = [
            'Chicken Rice Bowl',
            'Garlic Lemon Chicken',
            'Tomato Omelette',
            'Potato & Egg Salad',
            'Creamy Lemon Rice'
        ];

        foreach ($recipes as $title) {
            Recipe::create([
                'household_id' => 1,
                'title' => $title,
                'instructions' => 'Mix ingredients and cook.',
                'created_by' => 1,
            ]);
        }
    }
}
