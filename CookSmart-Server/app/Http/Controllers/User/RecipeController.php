<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\RecipeService;

class RecipeController extends Controller
{
    public function list($household_id)
    {
        return $this->responseJSON(
            RecipeService::list($household_id)
        );
    }

    public function get($id)
    {
        return $this->responseJSON(
            RecipeService::get($id)
        );
    }

    public function addOrUpdate(Request $request, $id = "add")
    {
        $result = RecipeService::addOrUpdate($request->all(), $id);
        return $this->responseJSON($result);
    }

    public function delete(Request $request)
    {
        $result = RecipeService::delete($request->id);
        return $this->responseJSON($result);
    }

    public function addIngredient(Request $request)
    {
        $result = RecipeService::addIngredient($request->all());
        return $this->responseJSON($result);
    }

    public function listIngredients($recipe_id)
    {
        return $this->responseJSON(
            RecipeService::listIngredients($recipe_id)
        );
    }
}
