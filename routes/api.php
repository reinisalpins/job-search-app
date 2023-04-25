<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => '/user'], function () {
        Route::group(['prefix' => '/profile'], function () {
            Route::group(['prefix' => '/{userId}', 'where' => ['userId' => '[0-9]+']], function () {
                Route::get('/', [UserController::class, 'getUserProfileInformation']);
                Route::post('/', [UserController::class, 'setUserProfileInformation']);
                Route::patch('/', [UserController::class, 'patchUserProfileInformation']);
            });
        });
    });
});


Route::group(['prefix' => '/user'], function () {
    Route::group(['prefix' => '/{userId}', 'where' => ['userId' => '[0-9]+']], function () {
        Route::patch('/changePassword', [UserController::class, 'changeUserPassword']);
    });
});
