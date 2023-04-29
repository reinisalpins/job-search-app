<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Employer\EmployerController;
use App\Http\Controllers\Listing\ListingController;
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

Route::group(['prefix' => '/employer'], function () {
    Route::post('/register', [AuthController::class, 'employerRegister']);
    Route::post('/login', [AuthController::class, 'employerLogin']);
});

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

    Route::group(['prefix' => '/employer'], function () {
        Route::group(['prefix' => '/profile'], function () {
           Route::group(['prefix' => '/{userId}', 'where' => ['userId' => '[0-9]+']], function () {
              Route::post('/', [EmployerController::class, 'setEmployerProfileInformation']);
              Route::patch('/', [EmployerController::class, 'updateEmployerProfileInformation']);
              Route::get('/', [EmployerController::class, 'getEmployerProfileInformation']);
           });
        });
    });

    Route::group(['prefix' => '/listing'], function () {
       Route::post('/', [ListingController::class, 'createJobListing']);
    });
});


Route::group(['prefix' => '/user'], function () {
    Route::group(['prefix' => '/{userId}', 'where' => ['userId' => '[0-9]+']], function () {
        Route::patch('/password', [UserController::class, 'changeUserPassword']);
    });
});
