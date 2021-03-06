<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home/{groupSlug?}', 'HomeController@index')->name('home');

Route::get('/task/setcomplete/{taskID}', 'TaskController@setComplete')->name('markComplete');
Route::get('/task/setinomplete/{taskID}', 'TaskController@setIncomplete')->name('markIncomplete');

Route::post('/group/create', 'GroupController@create')->name('group.create');
Route::post('/task/create/{groupSlug}', 'TaskController@create')->name('task.create');

Route::get('/task/archive/{taskID}', 'TaskController@archive')->name('task.archive');
Route::get('/task/restore/{taskID}', 'TaskController@restore')->name('task.restore');
Route::get('/task/delete/{taskID}', 'TaskController@delete')->name('task.delete');