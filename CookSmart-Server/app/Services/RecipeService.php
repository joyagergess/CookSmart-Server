<?php

namespace App\Services;

use App\Models\Recipe;
use App\Models\RecipeIngredient;
use App\Models\Ingredient;

class RecipeService
{
    public static function list($household_id)
    {
        return Recipe::where('household_id', $household_id)->get();
    }

    public static function get($id)
    {
        return Recipe::find($id);
    }

    public static function addOrUpdate($data, $id = "add")
    {
        if ($id === "add") {
            $recipe = new Recipe;
        } else {
            $recipe = Recipe::find($id);
            if (!$recipe) return null;
        }

        $recipe->household_id = $data['household_id'] ?? null;
        $recipe->title = $data['title'];
        $recipe->instructions = $data['instructions'];
        $recipe->created_by = $data['created_by'];

        $recipe->save();
        return $recipe;
    }

    public static function delete($id)
    {
        $recipe = Recipe::find($id);
        if (!$recipe) return null;

        $recipe->delete();
        return true;
    }
    
    public static function addIngredient($data){
        $ingredient = Ingredient::where('name', $data['ingredient_name'])->first();
    
        if (!$ingredient) {
            $ingredient = new Ingredient;
            $ingredient->name = $data['ingredient_name'];
            $ingredient->save();
        }
    
        $exists = RecipeIngredient::where('recipe_id', $data['recipe_id'])
            ->where('ingredient_id', $ingredient->id)
            ->first();
    
        if ($exists) {
            return ["error" => "Ingredient already added to this recipe"];
        }
    
        $recipeIngredient = new RecipeIngredient;
        $recipeIngredient->recipe_id = $data['recipe_id'];
        $recipeIngredient->ingredient_id = $ingredient->id;
        $recipeIngredient->amount = $data['amount'];
        $recipeIngredient->unit = $data['unit'];
    
        $recipeIngredient->save();
    
        return $recipeIngredient;
    }

    public static function listIngredients($recipe_id)
    {
        return RecipeIngredient::where('recipe_id', $recipe_id)
            ->with('ingredient')
            ->get();
    }
}
