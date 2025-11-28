<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\IngredientService;

class IngredientController extends Controller{
    public function list($id = null)   {
        return $this->responseJSON(
            IngredientService::get($id)
        );
    }

    public function addOrUpdate(Request $request, $id = "add") {
        $result = IngredientService::addOrUpdate($request->all(), $id);
        return $this->responseJSON($result);
    }

    public function delete(Request $request) {
        $result = IngredientService::remove($request->id);
        return $this->responseJSON($result);
    }
}
