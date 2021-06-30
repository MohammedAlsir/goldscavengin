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


Route::post('login', 'App\Http\Controllers\Api\UserController@login');

// Route for just user
Route::middleware('auth:api')->group( function () {
    // Route::resource('products', ProductController::class);
    // get all users
    Route::get('users', 'App\Http\Controllers\Api\UserController@users');
    // chang status
    Route::put('status/{id}', 'App\Http\Controllers\Api\UserController@status');
    // register
    Route::post('register', 'App\Http\Controllers\Api\UserController@register');
    // destroy Route
    Route::delete('destroy/{id}', 'App\Http\Controllers\Api\UserController@destroy');





});
