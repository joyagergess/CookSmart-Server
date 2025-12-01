<?php namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\HouseholdMemberService;

class HouseholdMemberController extends Controller{
    public function join(Request $request)
    {
        $result = HouseholdMemberService::joinWithInvite( $request->invite_code);
        return $this->responseJSON($result);
    }

    public function add(Request $request){
        $result = HouseholdMemberService::addMember($request->household_id, $request->user_id);
        return $this->responseJSON($result);
    }

    public function remove(Request $request) {
        $result = HouseholdMemberService::removeMember($request->member_id);
        return $this->responseJSON($result);
    }

    public function listByHousehold($household_id)  {
        $result = HouseholdMemberService::getByHousehold($household_id);
        return $this->responseJSON($result);
    }

    public function leave(Request $request){
        $result = HouseholdMemberService::leaveHousehold($request->user_id, $request->household_id);
        return $this->responseJSON($result);
    }
}
