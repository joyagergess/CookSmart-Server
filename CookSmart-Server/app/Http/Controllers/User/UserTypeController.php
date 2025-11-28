<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserTypeService;

class UserTypeController extends Controller{
    
    public function getAll($id = null){
        $result = UserTypeService::getUserTypes($id);
        return $this->responseJSON($result);
    }

    public function create(Request $request){
        $result = UserTypeService::create($request->all());

        if (!$result) {
            return $this->responseJSON(null, "failure", 400);
        }

        return $this->responseJSON($result);
    }

    public function delete(Request $request){
        $id = $request->id;

        $result = UserTypeService::delete($id);

        if (!$result) {
            return $this->responseJSON(null, "failure", 400);
        }

        return $this->responseJSON("user type deleted");
    }
}
