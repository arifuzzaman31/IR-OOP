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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Media
Route::get('/media', 'MediaController@index');                                # Get Media List
Route::get('/media/pageview', 'MediaController@pageview');                    # Get Media - Pagination
Route::get('/media/{id}', 'MediaController@index');                           # Get Single Media
Route::post('/media/upload', 'MediaController@upload');                       # Upload Media
Route::put('/media/{id}', 'MediaController@update');                          # Update Media
Route::delete('/media/{id}', 'MediaController@destroy');                      # Delete Media

Route::post('/templete_update/{id}', 'CategoryController@templete_update');
