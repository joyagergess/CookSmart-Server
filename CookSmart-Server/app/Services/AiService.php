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
        Pantry items: " . json_encode($pantry) . "
        
        For each missing ingredient, suggest 1–3 possible substitutions **using only items that are already in the pantry**.  
        If no good substitution exists, say 'No suitable substitution found'.
        
        Keep answers short and practical.
        Return a simple list: 
        Missing → Suggested substitutions
        ";
    
        return (new OpenAIService)->messageOnly($prompt);
    }

    public static function weeklySummary($household_id){
        $expenses = ExpenseService::lastWeek($household_id);
        $expiring = PantryItemService::expiringSoon($household_id, 5);
        $shopping = ShoppingListItemService::activity($household_id);
    
        $prompt = "
            Provide a VERY short weekly household summary based on the data below.
            Output ONLY plain text in ONE small paragraph. 
            Do NOT use bullet points, newlines, slashes, or any formatting.
    
            Expenses last week: {$expenses->toJson()}
            Items expiring soon: {$expiring->toJson()}
            Shopping list activity: {$shopping->toJson()}
    
            Include in the same short paragraph:
            - Spending patterns
            - Waste reduction ideas
            - Budget advice
            - Pantry usage insights
            Keep it friendly and simple, like you're advising a normal person.
         ";
    
        return (new OpenAIService)->messageOnly($prompt);
       }
    


    public static function recipeNutrition($recipe_id){
    $ingredients = RecipeService::listIngredients($recipe_id);

    if ($ingredients->isEmpty()) {
        return "No ingredients found for this recipe.";
    }

    $list = [];

    foreach ($ingredients as $item) {
        $list[] = [
            "name" => $item->ingredient->name,
            "amount" => $item->amount,
            "unit" => $item->unit
        ];
    }

    $prompt = "
    You are a nutrition expert.
    
    Given these ingredients with amounts:
    
    " . json_encode($list, JSON_PRETTY_PRINT) . "
    
    Return nutrition facts in EXACTLY this JSON format:
    
    {
      \"total_calories\": number,
      \"total_protein\": number,
      \"total_carbs\": number,
      \"total_fat\": number,
      \"per_ingredient\": [
          { \"name\": \"...\", \"calories\": number, \"protein\": number, \"carbs\": number, \"fat\": number }
      ]
    }
    
    Do NOT add explanations. ONLY return JSON.
    ";
    
        return (new OpenAIService)->messageOnly($prompt);
    }
    
    }
    