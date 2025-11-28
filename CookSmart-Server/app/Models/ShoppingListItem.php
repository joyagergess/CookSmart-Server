<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShoppingListItem extends Model
{
    protected $fillable = [
        'shopping_list_id',
        'ingredient_id',
        'quantity_needed',
        'unit',
        'is_bought'
    ];

    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
