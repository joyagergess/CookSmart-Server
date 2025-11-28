<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = ['name', 'default_unit'];

    public function pantryItems()
    {
        return $this->hasMany(PantryItem::class);
    }
}
