<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShoppingList;

class ShoppingListSeeder extends Seeder
{
    public function run(): void
    {
        ShoppingList::create(['household_id' => 1]);
        ShoppingList::create(['household_id' => 1]);
    }
}
