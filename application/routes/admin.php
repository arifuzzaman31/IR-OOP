<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EbookController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\CircularController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\TestController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['auth']], function () {


    Route::get('/', function () {
        echo  "This is from admin url";
    });

    // Admin Panel
    Route::get('/dashboard', [AdminController::class, 'index']);

    // Categories Templete template
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories/update/{type}', [CategoryController::class, 'store']);
    
    // Circular Controller
    Route::get('/circulars', [CircularController::class, 'index']);
    Route::get('/circulars/{id}', [CircularController::class, 'index']);

    Route::get('/circular_create', [CircularController::class, 'create']);
    Route::post('/circular_store', [CircularController::class, 'store']);
    Route::get('/circular_edit/{id}', [CircularController::class, 'edit']);
    Route::post('/circular_update/{id}', [CircularController::class, 'update']);
    Route::post('/circular_update_jury/{type}', [CircularController::class, 'update_jury_member']);
    Route::get('/circular_delete/{id}', [CircularController::class, 'circular_delete']);


    // Ebook Controller
    Route::get('/writings', [EbookController::class, 'writings']);
    Route::get('/ebooks', [EbookController::class, 'index']);
    Route::get('/ebooks/{id}', [EbookController::class, 'ebooks']);
    Route::post('/ebook_update_jury/{type}', [EbookController::class, 'update_jury_member']);
    Route::get('/ebook/generate_pdf/{slug}', [PublicationController::class, 'publication_generate_pdf']);


    // EBOOK CREATE - DEPRICATED X
    Route::get('/ebook/{method}/{templete_type}', [EbookController::class, 'ebook_templete']);   //  Method: create 
    Route::get('/ebook/{method}/{templete_type}/{slug}', [EbookController::class, 'ebook_templete']);   //  Method:  edit
    
    // ebook create/edit with ciruclar
    Route::get('/circular_ebook/{method}/{templete_type}/{circular_slug}', [EbookController::class, 'circular_ebook']);   //  Method: create
    Route::get('/circular_ebook/{method}/{templete_type}/{circular_slug}/{slug}', [EbookController::class, 'circular_ebook']);   //  Method:  edit


    Route::post('/ebook_store', [EbookController::class, 'ebook_store']);

    Route::get('/ebook_edit/{slug}', [EbookController::class, 'ebook_edit']);
    Route::put('/ebook_update/{slug}', [EbookController::class, 'ebook_update']);
    Route::get('/ebook_delete/{slug}', [EbookController::class, 'ebook_delete']);
    Route::POST('/ebook_status_update/{slug}', [EbookController::class, 'ebook_status_update']);

    Route::delete('/ebook_delete/{id}', [EbookController::class, 'ebook_delete']);


    // Publication Controller 
    Route::get('/publications', [PublicationController::class, 'index']);
    Route::get('/publication/view/{slug}', [PublicationController::class, 'publication_view']);
    Route::get('/publication/generate_pdf/{slug}', [PublicationController::class, 'publication_generate_pdf']);


    // Ebook Feedback
    Route::get('/evaluate/{slug}', [EvaluationController::class, 'create']);
    Route::post('/evaluate', [EvaluationController::class, 'store']);

    Route::get('/evaluations/{slug}', [EvaluationController::class, 'index']);


    // Users
    Route::get('/user/create', [UserController::class, 'user_create']);
    Route::post('/user/store', [UserController::class, 'store']);
    Route::get('/user/{id}', [UserController::class, 'user']);

    Route::get('/user/edit/{id}', [UserController::class, 'user_edit']);
    Route::post('/user/update/{id}', [UserController::class, 'update']);

    Route::get('/users', [UserController::class, 'users']);
    Route::get('/users/{type}', [UserController::class, 'users']);

    Route::get('/me', [AdminLoginController::class, 'getUser']);
    Route::get('logout', [AdminLoginController::class, 'logout'])->name('logout');



    // Settings
    Route::get('/settings', [SettingsController::class, 'settings']);    
    
    Route::get('/test_jury_auth/{ebook_id}/{jury_id}', [TestController::class, 'jury_auth_check']);

});
