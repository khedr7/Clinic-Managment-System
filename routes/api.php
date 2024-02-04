<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SpecializationController;
use App\Http\Controllers\UserController;
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

Route::group(['middleware' => 'SetLanguage'], function () {

    Route::group([
        'prefix' => '/auth',
        'controller' => AuthController::class,
    ], function () {
        Route::post('/register', 'register')->name('register');
        Route::post('/login', 'login')->name('login');
        Route::post('/logout', 'logout')->name('logout')->middleware('auth:sanctum');
    });

    Route::group([
        'prefix' => '/users',
        'controller' => UserController::class,
        'middleware' => ['auth:sanctum', 'isAdmin']
    ], function () {
        Route::get('/', 'getAll');
        Route::get('/{id}', 'find');
        Route::post('/', 'create');
        Route::post('/{id}', 'update');
        Route::delete('/{id}', 'delete');
    });

    Route::get('/specializations/doctors/{id}',  [UserController::class, 'specializationsDoctors']);

    Route::group([
        'prefix' => '/specializations',
        'controller' => SpecializationController::class,
    ], function () {
        Route::get('/', 'getAll');
        Route::get('/{id}', 'find');
        Route::post('/', 'create')->middleware(['auth:sanctum', 'isAdmin']);
        Route::post('/{id}', 'update')->middleware(['auth:sanctum', 'isAdmin']);
        Route::delete('/{id}', 'delete')->middleware(['auth:sanctum', 'isAdmin']);
    });

    Route::group([
        'prefix' => '/appointments',
        'controller' => AppointmentController::class,
        'middleware' => 'auth:sanctum'
    ], function () {
        Route::get('/', 'getAll');
        Route::get('/{id}', 'find');
        Route::post('/', 'create');
        Route::post('/update-status/{id}', 'updateStatus')->middleware('isAdminOrDoctor'); //admin and doctor only
        Route::post('/cancell/{id}', 'cancellStatus')->middleware(['isUser']); //user only
    });
});
