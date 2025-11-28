<?php

namespace App\Services;

use App\Models\Household;
use Illuminate\Support\Str;
use App\Models\HouseholdMember;

class HouseholdService
{
    public static function getHouseholds($id = null)
    {
        if (!$id) {
            return Household::all();
        }

        return Household::find($id);
    }

    public static function createOrUpdate($data, $id = "add"){

    if ($id === "add") {
        $household = new Household;

        $household->invite_code = strtoupper(Str::random(6));
    } 
    else {
        $household = Household::find($id);
        if (!$household) return null;
    }

    $household->name = $data['name'];

    $household->save();

    if ($id === "add" && isset($data['user_id'])) {

        $member = new HouseholdMember;
        $member->household_id = $household->id;
        $member->user_id = $data['user_id'];
        $member->joined_at = now();
        $member->save();
    }

    return $household;
    }



    public static function deleteHousehold($id)
    {
        $household = Household::find($id);

        if (!$household) return null;

        $household->delete();
        return true;
    }

    
    public static function getInviteCode($householdId){

    $household = Household::find($householdId);

    if (!$household) {
        return null;
    }

    return $household->invite_code;
   }
}
