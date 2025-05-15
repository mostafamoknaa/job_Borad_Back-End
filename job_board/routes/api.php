<?php

use App\Http\Controllers\API\EmployeerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\JobController;
use App\Http\Controllers\API\CategoryController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/employers', [EmployeerController::class, 'index']);
Route::get('/employers/{id}', [EmployeerController::class, 'show']);
Route::post('/employers/store', [EmployeerController::class,'store']);
Route::put('/employers/reupdate/{id}', [EmployeerController::class,'update']);


Route::put('/employers/updateuser/{id}/', [EmployeerController::class, 'updateUser']);


Route::put('/users/{id}', [UserController::class, 'update']);

Route::apiResource('jobs', JobController::class);
Route::apiResource('users', UserController::class);

Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/register', [UserController::class, 'register']);


Route::apiResource('categories', CategoryController::class);
