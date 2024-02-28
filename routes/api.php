<?php

use App\Http\Controllers\Api\V1\LoginController;
use App\Http\Controllers\Api\V1\RegisterController;
use App\Http\Controllers\Api\V1\TaskController;
use App\Http\Controllers\Api\V1\UserController;
use App\Models\Task;
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
Route::post('register',[RegisterController::class,'store']);
Route::post('login',[LoginController::class,'login']);
Route::group(['prefix'=>'v1','namespace'=>'App\Http\Controllers\Api\V1','middleware'=>'auth:sanctum'],function(){
Route::apiResource('tasks',TaskController::class)->middleware('auth:sanctum');
Route::apiResource('users',UserController::class);
Route::post('logout', [RegisterController::class, 'logout']);

});
// Route::group(['prefix'=>'v1','namespace'=>'App\Http\Controllers\Api\V1'],function(){
//     Route::apiResource('register',RegisterController::class);
// });


