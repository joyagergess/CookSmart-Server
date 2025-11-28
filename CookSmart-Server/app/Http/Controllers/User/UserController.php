<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller{
    function getAllUsers($id = null)
    {
        $result = UserService::getUsers($id);
        return $this->responseJSON($result);
    }

    function addOrUpdateUser(Request $request, $id = "add"){
        $result = UserService::createOrUpdate($request->all(), $id);

        if (!$result) {
            return $this->responseJSON(null, "failure", 404);
        }

        return $this->responseJSON($result);
    }

    function deleteUser(Request $request){
        $id=$request->id;

        $result=UserService::deleteUser($id);
        if (!$result){
            return $this->responseJson(null,"failure",404);
        }
        return $this->responseJson("user deleted");
    }
}
