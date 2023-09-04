<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\EducationController;

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

Route::get('users', [UserController::class, 'index']);
Route::post('usercreate', [UserController::class, 'store']);
Route::get('getuserdata/{id}', [UserController::class, 'getuserdata']);//
Route::post('updateuserdata/{id}', [UserController::class, 'updateuserdata']);
Route::delete('deleteuserdata/{id}', [UserController::class, 'deleteuserdata']);

Route::get('education', [EducationController::class, 'education']);
Route::post('educationadddata', [EducationController::class, 'educationadddata']);

