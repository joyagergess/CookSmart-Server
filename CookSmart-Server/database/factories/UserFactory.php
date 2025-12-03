<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_type_id' => 2, 
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'), 
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    
    public function admin(){
    return $this->state([
        'user_type_id' => 1,
    ]);
}

}
