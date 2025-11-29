<?php use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserTypeController;
use App\Http\Controllers\User\HouseholdController;
use App\Http\Controllers\User\HouseholdMemberController;
use App\Http\Controllers\User\IngredientController;
use App\Http\Controllers\User\PantryItemController;
use App\Http\Controllers\User\RecipeController;
use App\Http\Controllers\User\MealPlanController;
use App\Http\Controllers\User\MealPlanEntryController;
use App\Http\Controllers\User\ShoppingListItemController;
use App\Http\Controllers\User\ShoppingListController;
use App\Http\Controllers\User\ExpenseController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\Admin\UserController as UserAdminController;

Route::group(["prefix" => "v0.1"], function () {

    Route::post('/login',    [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);



});

Route::group(["prefix" => "v0.1", "middleware" => "auth:api"], function(){

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

    Route::group(["prefix" => "ingredients"], function () {
        Route::get('/{id?}', [IngredientController::class, "list"]);
        Route::post('/add_update/{id?}', [IngredientController::class, "addOrUpdate"]);
        Route::post('/delete', [IngredientController::class, "delete"]);
    });
    
    Route::group(["prefix" => "pantry"], function () {
        Route::get('/list/{household_id}', [PantryItemController::class, "list"]);
        Route::post('/add_update/{id?}', [PantryItemController::class, "addOrUpdate"]);
        Route::post('/delete', [PantryItemController::class, "delete"]);
    
        Route::post('/increase', [PantryItemController::class, "increase"]);
        Route::post('/decrease', [PantryItemController::class, "decrease"]);
    
        Route::get('/expiring_soon/{household_id}', [PantryItemController::class, "expiringSoon"]);
        Route::get('/low_quantity/{household_id}', [PantryItemController::class, "lowQuantity"]);
    });

    Route::group(["prefix" => "recipes"], function () {

        Route::get('/list/{household_id}', [RecipeController::class, "list"]);
        Route::get('/get/{id}', [RecipeController::class, "get"]);
        Route::post('/add_update/{id?}', [RecipeController::class, "addOrUpdate"]);
        Route::post('/delete', [RecipeController::class, "delete"]);
    
        Route::post('/add_ingredient', [RecipeController::class, "addIngredient"]);
        Route::get('/ingredients/{recipe_id}', [RecipeController::class, "listIngredients"]);
   });

     Route::group(["prefix" => "meal_plan"], function () {

        Route::post('/get_or_create', [MealPlanController::class, "getOrCreate"]);
        Route::get('/entries/{meal_plan_id}', [MealPlanController::class, "listEntries"]);
        Route::post('/add_entry', [MealPlanEntryController::class, "add"]);
        Route::post('/remove_entry', [MealPlanEntryController::class, "remove"]);
  });

    Route::group(["prefix" => "shopping_list"], function () {

       Route::get('/{household_id}', [ShoppingListController::class, "get"]);
       Route::post('/create', [ShoppingListController::class, "create"]);
  });

    Route::group(["prefix" => "shopping_list_items"], function () {
       Route::post('/add', [ShoppingListItemController::class, "add"]);
       Route::post('/delete', [ShoppingListItemController::class, "delete"]);
       Route::post('/toggle', [ShoppingListItemController::class, "toggle"]);
   });

    Route::group(["prefix" => "expenses"], function () {

       Route::get('/{household_id}', [ExpenseController::class, "list"]);
       Route::get('/week/{household_id}/{week_start}',[ExpenseController::class, "listByWeek"]);
       Route::post('/add_update/{id?}',  [ExpenseController::class, "addOrUpdate"]);
       Route::post('/delete', [ExpenseController::class, "delete"]);
    });




    Route::group(["prefix" => "admin", "middleware" => "isAdmin"], function () {
      Route::get('/users', [UserAdminController::class, "getAllUsers"]);
      Route::post('/delete_users', [UserAdminController::class, "deleteUser"]);
      Route::get('/households', [UserAdminController::class, "getAllHouseholds"]);
      Route::get('/household_members', [UserAdminController::class, "getAllHouseholdMembers"]);
      Route::post('/delete_household', [UserAdminController::class, "deleteHousehold"]);
      Route::post('/delete_household_member', [UserAdminController::class, "deleteHouseholdMember"]);

     });
});
