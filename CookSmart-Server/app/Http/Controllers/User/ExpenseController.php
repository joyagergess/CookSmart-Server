<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ExpenseService;

class ExpenseController extends Controller
{
    public function list($household_id){
        return $this->responseJSON(
            ExpenseService::list($household_id)
        );
    }

    public function listByWeek($household_id, $week_start){
        return $this->responseJSON(
            ExpenseService::listByWeek($household_id, $week_start)
        );
    }

    public function addOrUpdate(Request $request, $id = "add"){
        return $this->responseJSON(
            ExpenseService::addOrUpdate($request->all(), $id)
        );
    }

    public function delete(Request $request) {
        return $this->responseJSON(
            ExpenseService::delete($request->id)
        );
    }
}
