<?php

use App\Http\Controllers\API\ApplicationController;
use App\Http\Controllers\API\CandidateController;
use App\Http\Controllers\API\EmployeerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\JobController;
use App\Http\Controllers\API\CategoryController;
use App\Models\Employer;


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
Route::get('/employer/myjob/{id}',[EmployeerController::class,'myjob']);
Route::get('/top-companies', [EmployeerController::class, 'topCompanies']);
Route::get('/top-companies', function () {
    return Employer::with(['user', 'latestJob'])
        ->withCount('jobs')
        ->orderByDesc('jobs_count')
        ->take(6)
        ->get();
});


Route::put('/users/{id}', [UserController::class, 'update']);

Route::apiResource('jobs', JobController::class);
Route::apiResource('users', UserController::class);

Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/register', [UserController::class, 'register']);


Route::apiResource('categories', CategoryController::class);


Route::get('/employer/job/{id}',[JobController::class,'findEmployerJob']);

Route::get('/count/jobs/{id}',[ApplicationController::class,'countAllApplicantsOnJob']);

Route::put('/aprove/job/{id}',[JobController::class,'approveJob']);
Route::put('/reject/job/{id}',[JobController::class,'rejectJob']);

Route::get('allCandidates',[UserController::class,'getAllCandidates']);

// Route::get('/candidates',[CandidateController::class,'index']);
// Route::get('/candidates/{id}', [CandidateController::class, 'show']);

Route::apiResource('candidates', CandidateController::class);
Route::put('/candidates', [CandidateController::class, 'update'])->middleware('auth:api');

Route::get('/applications', [ApplicationController::class, 'index']);
Route::get('/oneapplications/{id}', [ApplicationController::class, 'show']);

Route::put('/updateapplications/{id}', [ApplicationController::class, 'updateStatus']);


Route::post('/create-checkout-session', [ApplicationController::class, 'createSession']);

Route::post('/addApplication', [ApplicationController::class, 'store']);


Route::middleware('auth:sanctum')->get('/notifications', function (Request $request) {
    return [
        'all' => $request->user()->notifications,
        'unread' => $request->user()->unreadNotifications,
    ];
});

Route::put('/jobs/{id}', [JobController::class, 'update']);

Route::get('/adminjob', [JobController::class, 'alljobs']);

Route::get('/userApplication', [ApplicationController::class, 'viewcanddidateappication']);

