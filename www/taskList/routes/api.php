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


Route::get('/', 'App\Http\Controllers\TaskAPIController@index');
Route::get('/{task}', 'App\Http\Controllers\TaskAPIController@get_task');
Route::post('/', 'App\Http\Controllers\TaskAPIController@create');
Route::put('/{task}', 'App\Http\Controllers\TaskAPIController@update');
Route::delete('/{task}', 'App\Http\Controllers\TaskAPIController@delete');