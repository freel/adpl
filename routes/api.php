<?php

use Illuminate\Http\Request;

use App\JobHistory;

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

Route::get('/', 'DownloadApiController@index')->name("api.index");
Route::post('/', 'DownloadApiController@store')->name("api.store");
