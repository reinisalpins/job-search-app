<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Employer\EmployerController;
use App\Http\Controllers\Listing\ListingController;
use App\Http\Controllers\JobSeeker\JobSeekerController;
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

Route::group(['prefix' => '/user'], function () {
    Route::group(['prefix' => '/{userId}', 'where' => ['userId' => '[0-9]+']], function () {
        Route::patch('/password', [AuthController::class, 'changePassword']);
    });
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => '/job-seeker'], function () {
        Route::group(['prefix' => '/{userId}', 'where' => ['userId' => '[0-9]+']], function () {

            Route::group(['prefix' => '/profile'], function () {
                Route::get('/', [JobSeekerController::class, 'getJobSeekerProfileInformation']);
                Route::post('/', [JobSeekerController::class, 'setJobSeekerProfileInformation']);
                Route::patch('/', [JobSeekerController::class, 'patchJobSeekerProfileInformation']);
            });

        });
    });

    Route::group(['prefix' => '/employer'], function () {
        Route::group(['prefix' => '/{userId}', 'where' => ['userId' => '[0-9]+']], function () {

            Route::group(['prefix' => '/profile'], function () {
                Route::get('/', [EmployerController::class, 'getEmployerProfileInformation']);
                Route::post('/', [EmployerController::class, 'setEmployerProfileInformation']);
                Route::patch('/', [EmployerController::class, 'updateEmployerProfileInformation']);
            });

            Route::group(['prefix' => '/listings'], function () {
                Route::get('/all', [ListingController::class, 'getAllEmployersListings']);
                Route::get('/active', [ListingController::class, 'getActiveEmployersListings']);
                Route::get('/inactive', [ListingController::class, 'getInactiveEmployersListings']);

                Route::post('/', [ListingController::class, 'createListing']);

                Route::group(['prefix' => '/{listingId}'], function () {
                    Route::get('/', [ListingController::class, 'getSelectedEmployerListing']);
                    Route::delete('/', [ListingController::class, 'deleteSelectedListing']);
                    Route::patch('/', [ListingController::class, 'updateListing']);
                });
            });
        });
    });
});

Route::group(['prefix' => '/listings'], function () {
    Route::get('/job', [ListingController::class, 'getAllJobListings']);
    Route::get('/internship', [ListingController::class, 'showAllInternshipListings']);
    Route::get('/freelance', [ListingController::class, 'showAllFreelanceListings']);
});
