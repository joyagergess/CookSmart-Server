<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeIngredient extends Model
{
    protected $fillable = [
        'recipe_id',
        'ingredient_id',
        'amount',
        'unit'
    ];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
