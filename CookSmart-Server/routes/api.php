<?php use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserTypeController;
use App\Http\Controllers\User\HouseholdController;
use App\Http\Controllers\User\HouseholdMemberController;

use App\Http\Controllers\Admin\UserController as UserAdminController;

Route::group(["prefix" => "v0.1"], function(){

    Route::group(["prefix" => "user"], function(){
        Route::get('/users/{id?}', [UserController::class, "getAllUsers"]);
        Route::post('/add_update_user/{id?}', [UserController::class, "addOrUpdateUser"]);
        Route::post('/delete_user', [UserController::class, "deleteUser"]);

        Route::get('/user_types/{id?}', [UserTypeController::class, "getAll"]);
        Route::post('/add_user_type', [UserTypeController::class, "create"]);
        Route::post('/delete_user_type', [UserTypeController::class, "delete"]);
    });

    Route::group(["prefix" => "household"], function() {
        Route::get('/{id?}', [HouseholdController::class, "getAll"]);
        Route::post('/add_update/{id?}', [HouseholdController::class, "addOrUpdate"]);
        Route::post('/delete', [HouseholdController::class, "delete"]);
        Route::get('/invite_code/{id}', [HouseholdController::class, "getInviteCode"]);
    });

    Route::group(["prefix" => "household_members"], function () {
        Route::post('/join', [HouseholdMemberController::class, "join"]);
        Route::post('/add', [HouseholdMemberController::class, "add"]);
        Route::post('/remove', [HouseholdMemberController::class, "remove"]);
        Route::get('/list/{household_id}', [HouseholdMemberController::class, "listByHousehold"]);
        Route::post('/leave', [HouseholdMemberController::class, "leave"]);

});




Route::group(["prefix" => "admin"], function () {
        Route::post('/delete_tasks', [UserAdminController::class, "deleteAllTasks"]);
    });
});
