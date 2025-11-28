<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PantryItemService as PantryService;

class PantryItemController extends Controller
{
    public function list($household_id)
    {
        return $this->responseJSON(
            PantryService::listByHousehold($household_id)
        );
    }

    public function addOrUpdate(Request $request, $id = "add")
    {
        $result = PantryService::addOrUpdate($request->all(), $id);
        return $this->responseJSON($result);
    }

    public function delete(Request $request)
    {
        return $this->responseJSON(
            PantryService::remove($request->id)
        );
    }

    public function increase(Request $request)
    {
        return $this->responseJSON(
            PantryService::increase($request->id, $request->amount)
        );
    }

    public function decrease(Request $request)
    {
        return $this->responseJSON(
            PantryService::decrease($request->id, $request->amount)
        );
    }

    public function expiringSoon($household_id)
    {
        return $this->responseJSON(
            PantryService::expiringSoon($household_id)
        );
    }

    public function lowQuantity($household_id)
    {
        return $this->responseJSON(
            PantryService::lowQuantity($household_id)
        );
    }
}
