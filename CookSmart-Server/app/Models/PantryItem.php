<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PantryItem extends Model
{
    protected $fillable = [
        'household_id',
        'ingredient_id',
        'quantity',
        'unit',
        'expiry_date'
    ];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }

    public function household()
    {
        return $this->belongsTo(Household::class);
    }
}
