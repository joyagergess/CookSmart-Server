<?php

namespace App\Services;
use App\Services\PantryItemService;
use App\Services\RecipeService;
use App\Services\ExpenseService;
use App\Services\ShoppingListItemService;
use App\Services\OpenAIService;


class AiService
{
    public static function pantryRecipes($household_id)
    {
        $pantry = PantryItemService::listForAI($household_id);

        if ($pantry->isEmpty()) {
            return "No pantry items found.";
        }

        $items = $pantry->map(fn($i) =>
            "{$i['name']} (qty: {$i['quantity']} {$i['unit']})"
        )->implode(", ");

        $prompt = "
            You are a chef. Create 1 recipe using ONLY these pantry items:
            $items

            Include:
            - Name
            - Ingredients
            - Short steps
            - Estimated calories
            - Difficulty (easy/medium)


            make it short .
        ";

        return (new OpenAIService)->messageOnly($prompt);
    }


    public static function substitutions($recipe_id, $household_id)
    {
        $recipeIngredients = RecipeService::listIngredients($recipe_id);
        $pantry = PantryItemService::listForAI($household_id);

        $missing = [];

        foreach ($recipeIngredients as $ingredient) {
            $name = $ingredient->ingredient->name;

            if (!collect($pantry)->firstWhere('name', $name)) {
                $missing[] = $name;
            }
        }

        if (!$missing) {
            return "All ingredients available!";
        }

        $prompt = "
            Missing ingredients: " . implode(", ", $missing) . "
            Pantry: " . json_encode($pantry) . "

            Suggest a maximum of 3 substitutions.
            Keep it short and practical.
        ";

        return (new OpenAIService)->messageOnly($prompt);
    }


    public static function weeklySummary($household_id)
    {
        $expenses = ExpenseService::lastWeek($household_id);
        $expiring = PantryItemService::expiringSoon($household_id, 5);
        $shopping = ShoppingListItemService::activity($household_id);

        $prompt = "
            Create a short, useful weekly household summary.

            EXPENSES (last 7 days):
            {$expenses->toJson()}

            EXPIRING SOON:
            {$expiring->toJson()}

            SHOPPING LIST ACTIVITY:
            {$shopping->toJson()}

            Include:
            - Spending patterns
            - Waste reduction ideas
            - Budget advice
            - Pantry usage insights
            - 2-3 suggested meals for next week
        ";

        return (new OpenAIService)->messageOnly($prompt);
    }
}
