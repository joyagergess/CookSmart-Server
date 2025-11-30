<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AiService;

class OpenAIController extends Controller
{
    public function pantryRecipes(Request $request)
    {
        return $this->responseJSON(
            AiService::pantryRecipes($request->household_id)
        );
    }

    public function substitutions(Request $request)
    {
        $request->validate([
            'recipe_id' => 'required|integer',
            'household_id' => 'required|integer'
        ]);

        return $this->responseJSON(
            AiService::substitutions($request->recipe_id, $request->household_id)
        );
    }

    public function weeklySummary(Request $request)
    {
        return $this->responseJSON(
            AiService::weeklySummary($request->household_id)
        );
    }

    public function recipeNutrition(Request $request)
    {
        return $this->responseJSON(
            AiService::recipeNutrition($request->recipe_id)
        );
    }
}
