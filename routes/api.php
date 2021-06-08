<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::Get('detail', [AuthController::class, 'detail']);

});

Route::post('/user/create',[UserController::class, 'create']);
Route::post('/post/create', [PostController::class, 'create']);
Route::get('/post/detail', [PostController::class, 'detail']);
Route::put('/post/update', [PostController::class, 'update']);
Route::delete('/post/delete', [PostController::class, 'delete']);
Route::get('/posts', [PostController::class, 'index']);
