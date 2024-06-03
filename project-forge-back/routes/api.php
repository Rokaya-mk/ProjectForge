<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\PermissionController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Departments Routes 
Route::post('login', [AuthController::class,'login']);
Route::post('register', [AuthController::class,'register']);
Route::middleware('auth:api')->group( function (){
    Route::post('logout',[AuthController::class,'logout']);
    Route::get('user-profile',[AuthController::class,'userProfile']);
    Route::resource('departments', DepartmentController::class)->except(['create','show','edit']);
    Route::get('departments/searchDepartment', [DepartmentController::class,'searchDepartment']);
    Route::resource('roles', RoleController::class);
    Route::get('searchRole', [RoleController::class,'searchRole']);
    Route::resource('permissions', PermissionController::class)->except(['create','edit']);
    Route::get('searchPermission', [PermissionController::class, 'searchPermission']);
    Route::get('users', [UserController::class,'index']);
    Route::get('users/searchUser', [UserController::class,'searchUser']);
    Route::post('users', [UserController::class,'store']);
    Route::put('users/{user}', [UserController::class, 'update']);
    Route::delete('users/{user}', [UserController::class, 'destroy']);
    Route::get('users/userRolesPermissions',[UserController::class,'userRolesPermissions']);
    Route::get('users/roles',[UserController::class,'allRoles']);
    Route::get('users/permissions',[UserController::class,'allPermissions']);
    Route::get('profile',[ProfileController::class,'index']);
    Route::post('profile/passwordUpdate/{id}',[ProfileController::class,'updatePassword']);
});
