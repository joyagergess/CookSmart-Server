<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'user_type_id' => 2,
            'name' => 'Fadi',
            'email' => 'fadi@example.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'user_type_id' => 2,
            'name' => 'Nabiha',
            'email' => 'nabiha@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
