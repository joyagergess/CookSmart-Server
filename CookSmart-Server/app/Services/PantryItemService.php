<?php

namespace App\Services;

use App\Models\PantryItem;
use App\Models\Ingredient;

class PantryItemService
{
    public static function listByHousehold($household_id) {
        return PantryItem::where('household_id', $household_id)
            ->with('ingredient')
            ->get();
    }

    public static function addOrUpdate($data, $id = "add")  {
       if ($id === "add") {
         $item = new PantryItem;
        } else {
         $item = PantryItem::find($id);
        }

        if (!$item) return null;

        if (isset($data['ingredient_name'])) {
            $ingredient = Ingredient::firstOrCreate([
                'name' => $data['ingredient_name']
            ]);
            $item->ingredient_id = $ingredient->id;
        } else {
            $item->ingredient_id = $data['ingredient_id'];
        }

        $item->household_id = $data['household_id'];
        $item->quantity     = $data['quantity'];
        $item->unit         = $data['unit'];
        $item->expiry_date  = $data['expiry_date'];

        $item->save();
        return $item;
    }

    public static function remove($id){
        $item = PantryItem::find($id);
        if (!$item) return null;

        $item->delete();
        return true;
    }

    public static function increase($id, $amount) {
        $item = PantryItem::find($id);
        if (!$item) return null;

        $item->quantity += $amount;
        $item->save();
        return $item;
    }

    public static function decrease($id, $amount){
        $item = PantryItem::find($id);
        if (!$item) return null;

        $item->quantity -= $amount;
        if ($item->quantity < 0) $item->quantity = 0;

        $item->save();
        return $item;
    }

    public static function expiringSoon($household_id, $days = 5)
    {
        return PantryItem::where('household_id', $household_id)
            ->whereDate('expiry_date', '<=', now()->addDays($days))
            ->orderBy('expiry_date')
            ->get();
    }

    public static function lowQuantity($household_id)
    {
        return PantryItem::where('household_id', $household_id)
            ->where('quantity', '<', 4)
            ->get();
    }
}
