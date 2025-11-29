<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserService;

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
}
