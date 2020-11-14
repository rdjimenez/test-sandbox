<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'App\Http\Controllers\TaskController@index')->name('index');
Route::get('/create', 'App\Http\Controllers\TaskController@create')->name('task.add');
Route::post('/', 'App\Http\Controllers\TaskController@save_task')->name('task.save');
Route::get('/edit/{task}', 'App\Http\Controllers\TaskController@edit')->name('task.edit');
Route::patch('/edit/{task}', 'App\Http\Controllers\TaskController@update')->name('task.update');
Route::delete('/delete/{task}', 'App\Http\Controllers\TaskController@delete')->name('task.delete');