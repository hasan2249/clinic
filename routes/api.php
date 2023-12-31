<?php

use Illuminate\Http\Request;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::group(['namespace' => 'Api\V1', 'prefix' => 'v1', 'as' => 'v1.'], function () {
    Route::group(['prefix' => 'auth', 'middleware' => ['guest']], function () {
        // Route::post('register', 'RegisterController@register');
        Route::post('login', 'AuthController@login');
        // Password Reset
        // Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail'); 
    });

    Route::group(['middleware' => ['auth:api']], function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('logout', 'AuthController@logout');
            Route::get('me', 'AuthController@me');
        });
    });
    // Auto-Generated:  Patients
    Route::apiResource('Patients', 'PatientsController');
    // Auto-Generated:  Appointments
    Route::apiResource('appointments', 'AppointmentsController');
    // Auto-Generated:  Sessions
    Route::apiResource('sessions', 'SessionsController');
    // Auto-Generated:  Mes
    Route::apiResource('mes', 'MesController');
    // Auto-Generated:  Costs
    Route::apiResource('costs', 'CostsController');
});
