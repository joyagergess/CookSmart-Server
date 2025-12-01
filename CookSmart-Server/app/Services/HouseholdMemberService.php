<?php

namespace App\Services;

use App\Models\Household;
use App\Models\HouseholdMember;
use App\Models\User;

class HouseholdMemberService
{
    
   public static function joinWithInvite($invite_code){
    $userId = auth()->id();   

    if (!$userId) {
        return ["error" => "Not authenticated"];
    }

    $household = Household::where('invite_code', $invite_code)->first();
    if (!$household) {
        return ["error" => "Invalid invite code"];
    }

    $exists = HouseholdMember::where('household_id', $household->id)
                             ->where('user_id', $userId)
                             ->first();

    if ($exists) {
        // Return the household ID even if already a member
        return [
            "status" => "success",
            "payload" => [
                "household_id" => $household->id,
                "message" => "Already a member"
            ]
        ];
    }

    $member = new HouseholdMember();
    $member->household_id = $household->id;
    $member->user_id = $userId;
    $member->joined_at = now();
    $member->save();

    return [
        "status" => "success",
        "payload" => [
            "household_id" => $household->id,
            "message" => "Joined successfully"
        ]
    ];
}


    public static function addMember($household_id, $user_id)
    {
        $household = Household::find($household_id);
        if (!$household) return ["error" => "Household not found"];

        $user = User::find($user_id);
        if (!$user) return ["error" => "User not found"];

        $exists = HouseholdMember::where('household_id', $household_id)
                                 ->where('user_id', $user_id)
                                 ->first();
                                 
        if ($exists) return ["error" => "User already a member"];

        $member = new HouseholdMember();
        $member->household_id = $household_id;
        $member->user_id = $user_id;
        $member->joined_at = now();
        $member->save();

        return $member;
    }


    public static function removeMember($member_id)
    {
        $member = HouseholdMember::find($member_id);
        if (!$member) return ["error" => "Member not found"];

        $member->delete();
        return true;
    }

    public static function leaveHousehold($user_id, $household_id)
    {
        $member = HouseholdMember::where('household_id', $household_id)
                                 ->where('user_id', $user_id)
                                 ->first();

        if (!$member) return ["error" => "User is not a member of this household"];

        $member->delete();
        return true;
    }


    public static function getByHousehold($household_id)
    {
        return HouseholdMember::where('household_id', $household_id)
                              ->with('user')  
                              ->get();
    }
   
    public static function getAll(){
    return \App\Models\HouseholdMember::with('user', 'household')->get();
  }



}
