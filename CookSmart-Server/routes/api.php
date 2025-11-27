<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\UserController as UserAdminController;

Route::group(["prefix" => "v0.1"], function(){
    //Authenticated Routes
    Route::group(["prefix" => "user"], function(){
        Route::get('/users/{id?}', [UserController::class, "getAllUsers"]);
        Route::post('/add_update_user/{id?}', [UserController::class, "addOrUpdateUser"]);
    });

    //Authenticated Routes
    Route::group(["prefix" => "admin"], function(){
        Route::post('/delete_tasks', [UserAdminController::class, "deleteAllTasks"]);
    });
});

//Unauthenticated Routes
Route::post('/login', [TaskController::class, "addTask"]);
Route::post('/register', [TaskController::class, "addTask"]);





/*
1- Routing DONE
2- Migrations DONE
3- Controllers
4- Models 
5- Services DONE
6- Seeders / Factory
6- Traits DONE

7- Middlewares
8- Advancded Models 
9- Testing
*/  




