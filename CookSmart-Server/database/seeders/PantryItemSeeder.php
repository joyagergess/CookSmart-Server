<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PantryItem;

class PantryItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [1, 3, 'pcs'],
            [4, 1, 'kg'],
            [6, 0.5, 'L'],
            [2, 2, 'pcs'],
            [10, 1, 'L'],
        ];

        foreach ($items as $i) {
            PantryItem::create([
                'household_id' => 1,
                'ingredient_id' => $i[0],
                'quantity' => $i[1],
                'unit' => $i[2],
                'expiry_date' => now()->addDays(rand(2, 12)),
            ]);
        }
    }
}
