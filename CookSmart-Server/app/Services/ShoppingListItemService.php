<?php 
namespace App\Services;

use App\Models\ShoppingListItem;
use App\Models\Ingredient;

class ShoppingListItemService{
    public static function addItem($data){
        $ingredient = Ingredient::firstOrCreate(
            ['name' => $data['ingredient_name']],
            []
        );

        $item = new ShoppingListItem;
        $item->shopping_list_id = $data['shopping_list_id'];
        $item->ingredient_id = $ingredient->id;
        $item->quantity_needed = $data['quantity_needed'];
        $item->unit = $data['unit'];
        $item->is_bought = false;
        $item->save();

        return $item;
    }

    public static function deleteItem($id){
        $item = ShoppingListItem::find($id);
        if (!$item) return null;

        return $item->delete();
    }

    public static function toggleBought($id){
        $item = ShoppingListItem::find($id);
        if (!$item) return null;

        $item->is_bought = !$item->is_bought;
        $item->save();

        return $item;
    }
}
