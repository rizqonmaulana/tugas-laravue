<?php

use App\Http\Controllers\TodoController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('food', 'FoodController@index');
Route::post('food', 'FoodController@store');
Route::post('food/edit/{id}', 'FoodController@edit');
Route::post('food/delete/{id}', 'FoodController@delete');
