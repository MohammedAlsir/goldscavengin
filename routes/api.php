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

// Route for login for Admin
Route::post('login', 'App\Http\Controllers\Api\AdminController@login');
// Route for login for User
Route::post('userlogin/{mac}', 'App\Http\Controllers\Api\UserController@userlogin');

// Route for just user
Route::middleware('auth:api')->group( function () {
    // Route for get all users
    Route::get('users', 'App\Http\Controllers\Api\AdminController@users');
    // Route for chang status
    Route::put('status/{id}', 'App\Http\Controllers\Api\AdminController@status');
    // Route for register
    Route::post('register', 'App\Http\Controllers\Api\AdminController@register');
    // Route for destroy
    Route::delete('destroy/{id}', 'App\Http\Controllers\Api\AdminController@destroy');
    // Route for edit user data
    Route::put('user','App\Http\Controllers\Api\AdminController@user' );
    // Route for logout user
    // Route::post('logout','App\Http\Controllers\Api\AdminController@logout');
});

//
