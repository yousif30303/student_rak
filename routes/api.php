<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\StudentController;

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

Route::post('register', [StudentController::class, 'register']);
Route::post('login', [StudentController::class, 'login']);
Route::post('forgetpassword', [StudentController::class, 'forgetpassword']);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('profile', [StudentController::class, 'profile']);
    Route::post('changePassword', [StudentController::class, 'changePassword']);
    Route::get('test/{registration_id}/detail', [ApiController::class, 'testDetail']);
    Route::get('training/{registration_id}/detail', [ApiController::class, 'trainingDetail']);
    Route::post('contact', [StudentController::class, 'contact']);
    Route::get('course', [ApiController::class, 'courseDetails']);
    Route::post('logout', [StudentController::class, 'logout']);
});
//Route::get('getStudent', [StudentController::class, 'getStudent']);


Route::get('testReg', [ApiController::class, 'regTest']);

Route::get('groupExample', [ApiController::class, 'groupExample']);

Route::get('example', [ApiController::class, 'example']);




