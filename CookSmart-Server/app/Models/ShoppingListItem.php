<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ingredient;
use App\Models\ShoppingList;

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
    
    public function shoppingList(){
    return $this->belongsTo(ShoppingList::class, 'shopping_list_id');
     }

 }