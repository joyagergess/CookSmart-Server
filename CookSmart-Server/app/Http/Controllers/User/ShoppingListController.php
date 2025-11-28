<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ShoppingListService;

class ShoppingListController extends Controller
{
    public function get($household_id){
        return $this->responseJSON(
            ShoppingListService::list($household_id)
        );
    }

    public function create(Request $request){
        return $this->responseJSON(
            ShoppingListService::create($request->household_id)
        );
    }
}

