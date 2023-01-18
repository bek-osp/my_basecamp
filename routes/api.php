<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


//User Auth Routes
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'index']);
Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'index']);

// User for authorization Routes
Route::group(['middleware' => 'auth:sanctum'], function () {
    //User Routes
    Route::get('/user', [\App\Http\Controllers\UserController::class, 'index']);

    //Projects Routes
    Route::post('/project/create', [\App\Http\Controllers\Project\CreateController::class, 'index']);
    Route::get('/project/{id}', [\App\Http\Controllers\Project\GetController::class, 'get']);
    Route::get('/projects', [\App\Http\Controllers\Project\GetController::class, 'index']);
    Route::put('/project/{id}', [\App\Http\Controllers\Project\EditController::class, 'index']);

    Route::post('/logout', [\App\Http\Controllers\Auth\LogoutController::class, 'index']);
});
