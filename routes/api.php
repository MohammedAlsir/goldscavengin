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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route for login
Route::post('login', 'App\Http\Controllers\Api\UserController@login');

// Route for just user
Route::middleware('auth:api')->group( function () {
    // Route::resource('products', ProductController::class);

    // Route for get all users
    Route::get('users', 'App\Http\Controllers\Api\UserController@users');
    // Route for chang status
    Route::put('status/{id}', 'App\Http\Controllers\Api\UserController@status');
    // Route for register
    Route::post('register', 'App\Http\Controllers\Api\UserController@register');
    // Route for destroy
    Route::delete('destroy/{id}', 'App\Http\Controllers\Api\UserController@destroy');
    // Route for edit user data
    Route::put('user','App\Http\Controllers\Api\UserController@user' );

});
