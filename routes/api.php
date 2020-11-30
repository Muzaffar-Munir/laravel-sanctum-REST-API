<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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


// without any auth


/**
 *
 * just implementing for test
 */
Route::post('/login','App\Http\Controllers\Api\UsersController@login');



/**
 *
 * protected routes we can also defined here multiple route and also we can call
 *  it in controller constructor
 */

/**
 * sanctum first verfy SPA request to send get request on  sanctum/csrf-cookie route
 */

// Route::middleware('auth:sanctum')->get('/protected-route','App\Http\Controllers\Api\UsersController@protectedRoute');


// Route::middleware('auth:sanctum')->post('/post-protected-route','App\Http\Controllers\Api\UsersController@protectedRoute');

// Route::middleware('auth:sanctum')->get('/get-users','App\Http\Controllers\Api\UsersController@index');

Route::post('/store-user','App\Http\Controllers\Api\UsersController@store');


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/protected-route','App\Http\Controllers\Api\UsersController@protectedRoute');
    Route::get('/get-users','App\Http\Controllers\Api\UsersController@index');
    Route::post('/post-protected-route','App\Http\Controllers\Api\UsersController@protectedRoute');
    Route::post('/update-auth-user','App\Http\Controllers\Api\UsersController@edit');
    Route::post('/delete-auth-user','App\Http\Controllers\Api\UsersController@destroy');
});
