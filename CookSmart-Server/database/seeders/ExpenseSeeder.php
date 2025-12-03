<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expense;

class ExpenseSeeder extends Seeder
{
    public function run(): void
    {
        $stores = ['Carrefour', 'Spinneys', 'Le Charcutier', 'TSC', 'Mazraa Market'];

        for ($i = 0; $i < 6; $i++) {
            Expense::create([
                'household_id' => 1,
                'amount' => rand(5, 50),
                'date' => now()->subDays(rand(0, 10)),
                'store' => $stores[array_rand($stores)],
            ]);
        }
    }
}
