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
            ->with('ingredient')
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

    public static function listForAI($household_id){
    return PantryItem::where('household_id', $household_id)
        ->with('ingredient:id,name')
        ->get()
        ->map(function ($item) {
            return [
                'name' => $item->ingredient->name,
                'quantity' => $item->quantity,
                'unit' => $item->unit
            ];
        });
      }
      
    public static function expiryDashboard($household_id, $days = 7){
        $items = PantryItem::where('household_id', $household_id)
            ->with('ingredient')
            ->where('expiry_date', '<=', now()->addDays($days))   
            ->orderBy('expiry_date', 'asc')
            ->get();
    
        return $items->map(function ($item) {
    
            $daysLeft = now()->diffInDays($item->expiry_date, false);
    
            $badge = 
                $daysLeft <= 0 ? "EXPIRED" :
                ($daysLeft <= 2 ? "USE FIRST" :
                ($daysLeft <= 5 ? "EXPIRING SOON" : "NORMAL"));
    
            return [
                "id"        => $item->id,
                "name"      => $item->ingredient->name,
                "quantity"  => $item->quantity,
                "unit"      => $item->unit,
                "expiry"    => $item->expiry_date,
                "days_left" => $daysLeft,
                "badge"     => $badge
            ];
        });
    }
    
}
