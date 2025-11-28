<?php 
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MealPlanService;

class MealPlanEntryController extends Controller{
    public function add(Request $request) {
        $entry = MealPlanService::addEntry($request->all());
        return $this->responseJSON($entry);
    }

    public function remove(Request $request)  {
        $result = MealPlanService::removeEntry($request->id);
        return $this->responseJSON($result);
    }
}
