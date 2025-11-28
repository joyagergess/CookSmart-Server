<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MealPlanService;

class MealPlanController extends Controller{

    public function getOrCreate(Request $request)   {
        $plan = MealPlanService::getOrCreate(
            $request->household_id,
            $request->week_start_date
        );

        return $this->responseJSON($plan);
    }

    public function listEntries($meal_plan_id)  {
        return $this->responseJSON(
            MealPlanService::getEntries($meal_plan_id)
        );
    }
}
