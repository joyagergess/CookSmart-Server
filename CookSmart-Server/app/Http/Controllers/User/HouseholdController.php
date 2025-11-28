<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\HouseholdService;

class HouseholdController extends Controller
{
    public function getAll($id = null)
    {
        $result = HouseholdService::getHouseholds($id);
        return $this->responseJSON($result);
    }

    public function addOrUpdate(Request $request, $id = "add")
    {
        $result = HouseholdService::createOrUpdate($request->all(), $id);

        if (!$result) {
            return $this->responseJSON(null, "failure", 404);
        }

        return $this->responseJSON($result);
    }

    public function delete(Request $request)
    {
        $result = HouseholdService::deleteHousehold($request->id);

        if (!$result) {
            return $this->responseJSON(null, "failure", 404);
        }

        return $this->responseJSON("Household deleted");
    }

    public function getInviteCode($id){

    $result = HouseholdService::getInviteCode($id);

    if (!$result) {
        return $this->responseJSON(null, "failure", 404);
    }

    return $this->responseJSON($result);
}

}
