<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShoppingListItem;

class ShoppingListItemSeeder extends Seeder
{
    public function run(): void
    {
        for ($list = 1; $list <= 2; $list++) {
            for ($i = 0; $i < 3; $i++) {
                ShoppingListItem::create([
                    'shopping_list_id' => $list,
                    'ingredient_id' => rand(1, 10),
                    'quantity_needed' => rand(1, 5),
                    'unit' => 'pcs',
                ]);
            }
        }
    }
}
