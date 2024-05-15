<?php

use App\Http\Controllers\API\DepartmentController;
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
Route::resource('departments', DepartmentController::class)->middleware('auth:api');
Route::get('users', [UserController::class,'index'])->middleware('auth:api');
Route::post('users', [UserController::class,'store'])->middleware('auth:api');
Route::put('users/{user}', [UserController::class, 'update'])->middleware('auth:api');
Route::delete('users/{user}', [UserController::class, 'destroy'])->middleware('auth:api');
Route::get('users/userRolesPermissions',[UserController::class,'userRolesPermissions'])->middleware('auth:api');
Route::get('users/roles',[UserController::class,'allRoles'])->middleware('auth:api');
Route::get('users/permissions',[UserController::class,'allPermissions'])->middleware('auth:api');
