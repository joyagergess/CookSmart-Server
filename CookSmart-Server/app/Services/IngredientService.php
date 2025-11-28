<?php

namespace App\Services;

use App\Models\Ingredient;

class IngredientService
{
    public static function get($id = null)
    {
        return $id ? Ingredient::find($id) : Ingredient::all();
    }

    public static function addOrUpdate($data, $id = "add")
    {
      if ($id === "add") {
        $ingredient = new Ingredient;
     } else {
        $ingredient = Ingredient::find($id);
      }
        if (!$ingredient) return null;

        $ingredient->name = $data['name'];
        $ingredient->save();

        return $ingredient;
    }

    public static function remove($id)
    {
        $ingredient = Ingredient::find($id);
        if (!$ingredient) return null;

        return $ingredient->delete();
    }
}
