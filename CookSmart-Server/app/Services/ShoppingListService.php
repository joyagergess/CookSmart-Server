<?php
namespace App\Services;

use App\Models\ShoppingList;

class ShoppingListService{
    public static function list($household_id){
        return ShoppingList::where('household_id', $household_id)
            ->with('items.ingredient')
            ->first();
    }

    public static function create($household_id){
        $list = new ShoppingList;
        $list->household_id = $household_id;
        $list->save();

        return $list;
    }
}
