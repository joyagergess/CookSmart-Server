<?php 
namespace App\Services;

use App\Models\ShoppingListItem;
use App\Models\Ingredient;
use \App\Models\PantryItem;

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
    $item = ShoppingListItem::with('ingredient')->find($id);
    if (!$item) return null;

    $item->is_bought = !$item->is_bought;
    $item->save();

    if ($item->is_bought) {
        $householdId = $item->shoppingList->household_id;

        $existing =PantryItem::where('household_id', $householdId)
            ->where('ingredient_id', $item->ingredient_id)
            ->first();

        if ($existing) {
          
            $existing->quantity += $item->quantity_needed;
            $existing->save();
        } else {
           
                PantryItem::create([
                'household_id' => $householdId,
                'ingredient_id' => $item->ingredient_id,
                'quantity'     => $item->quantity_needed,
                'unit'         => $item->unit,
                'expiry_date'  => now()->addDays(30) 
            ]);
         }
     }

     return $item;
   }


    public static function activity($household_id){
     $list = ShoppingListService::list($household_id);

     if (!$list || $list->items->isEmpty()) {
        return collect([]);
     }

     return $list->items->map(function ($item) {
        return [
            'name'      => $item->ingredient->name,
            'quantity'  => $item->quantity_needed,
            'unit'      => $item->unit,
            'is_bought' => $item->is_bought,
        ];
     });
   }


}