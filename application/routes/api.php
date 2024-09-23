<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Media
Route::get('/media', [MediaController::class, 'index']);                                # Get Media List
Route::get('/media/pageview', [MediaController::class, 'pageview']);                    # Get Media - Pagination
Route::get('/media/{id}', [MediaController::class, 'index']);                           # Get Single Media
Route::post('/media/upload', [MediaController::class, 'upload']);                       # Upload Media
Route::put('/media/{id}', [MediaController::class, 'update']);                          # Update Media
Route::delete('/media/{id}', [MediaController::class, 'destroy']);                      # Delete Media


Route::post('/templete_update/{id}', [CategoryController::class, 'templete_update']);
