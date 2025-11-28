<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public static function getUsers($id = null)
    {
        if (!$id) {
            return User::all();
        }
        return User::find($id);
    }

    public static function createOrUpdate($data, $id = "add")
    {
        if ($id === "add") {
            $user = new User;
            $user->user_type_id = 2;
        } 
        else {
            $user = User::find($id);
            if (!$user) {
                return null;
            }
        }

        $user->name  = $data['name'];
        $user->email = $data['email'];

        if ($id === "add" || !empty($data['password'])) {
            $user->password = bcrypt($data['password']);
        }

        $user->save();
        return $user;
    }
    
   public static function deleteUser($id){
                                       
    $user = User::find($id);

    if (!$user) {
        return null;
    }

    $user->delete();
    return true;
  }

}
