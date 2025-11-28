<?php 
namespace App\Services;

use App\Models\MealPlan;
use App\Models\MealPlanEntry;

class MealPlanService{
    public static function getOrCreate($household_id, $week_start){
        $plan = MealPlan::where('household_id', $household_id)
                        ->where('week_start_date', $week_start)
                        ->first();

        if (!$plan) {
            $plan = new MealPlan;
            $plan->household_id = $household_id;
            $plan->week_start_date = $week_start;
            $plan->save();
        }

        return $plan;
    }

    public static function addEntry($data){
        $entry = new MealPlanEntry;
        $entry->meal_plan_id = $data['meal_plan_id'];
        $entry->day_of_week = $data['day_of_week'];
        $entry->meal_type = $data['meal_type'];
        $entry->recipe_id = $data['recipe_id'];
        $entry->save();

        return $entry;
    }

    public static function removeEntry($id){
        $entry = MealPlanEntry::find($id);
        if (!$entry) return null;

        $entry->delete();
        return true;
    }

    public static function getEntries($meal_plan_id){
        return MealPlanEntry::where('meal_plan_id', $meal_plan_id)
            ->with('recipe')
            ->get();
    }
}
