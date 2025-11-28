<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ShoppingListItemService;

class ShoppingListItemController extends Controller
{
    public function add(Request $request){
        return $this->responseJSON(
            ShoppingListItemService::addItem($request->all())
        );
    }

    public function delete(Request $request){
        return $this->responseJSON(
            ShoppingListItemService::deleteItem($request->id)
        );
    }

    public function toggle(Request $request){
        return $this->responseJSON(
            ShoppingListItemService::toggleBought($request->id)
        );
    }
}
