<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Household;
use App\Models\HouseholdMember;

use App\Services\UserService;
use App\Services\HouseholdService;
use App\Services\HouseholdMemberService;

class UserController extends Controller
{
    public function deleteUser(Request $request){
        $userId = $request->id;

        if (! $userId) {
            return $this->responseJSON(null, "User ID is required", 400);
        }

        $deleted = UserService::deleteUser($userId);

        if (! $deleted) {
            return $this->responseJSON(null, "User does not exist", 404);
        }

        return $this->responseJSON("User deleted successfully");
    }


    public function getAllUsers(){
        return $this->responseJSON(UserService::getUsers());
        }

    public function getAllHouseholds(){
        return $this->responseJSON(HouseholdService::getHouseholds());
    }

    public function getAllHouseholdMembers(){
      return $this->responseJSON(HouseholdMemberService::getAll());
    }

    public function deleteHousehold(Request $request){
        $id = $request->id;

        if (!$id) {
            return $this->responseJSON(null, "Household ID required", 400);
        }

        $deleted = HouseholdService::deleteHousehold($id);

        if (!$deleted) {
            return $this->responseJSON(null, "Household not found", 404);
        }

        return $this->responseJSON("Household deleted successfully");
    }

  
    public function deleteHouseholdMember(Request $request){
        $id = $request->id;

        if (!$id) {
            return $this->responseJSON(null, "Household Member ID required", 400);
        }

        $deleted = HouseholdMemberService::removeMember($id);

        if (!$deleted) {
            return $this->responseJSON(null, "Household member not found", 404);
        }

        return $this->responseJSON("Household member deleted successfully");
    }



}
