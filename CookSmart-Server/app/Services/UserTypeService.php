<?php

namespace App\Services;

use App\Models\UserType;

class UserTypeService
{
    public static function getUserTypes($id = null) {
        if (!$id) {
            return UserType::all();
        }

        return UserType::find($id);
    }

    public static function create($data){
        $type = new UserType;
        $type->name = $data['name'];
        $type->save();

        return $type;
    }

    public static function delete($id)  {
        $type = UserType::find($id);

        if (!$type) return null;

        return $type->delete();
    }
}
