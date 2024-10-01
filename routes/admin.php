<?php

use Illuminate\Support\Facades\Route;

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
    Route::get('/dashboard', 'AdminController@index');

    // Categories Templete template
    Route::get('/categories', 'CategoryController@index');
    Route::post('/categories/update/{type}', 'CategoryController@store');

    // Circular Controller
    Route::get('/circulars', 'CircularController@index');
    Route::get('/circulars/{id}', 'CircularController@index');

    Route::get('/circular_create', 'CircularController@create');
    Route::post('/circular_store', 'CircularController@store');
    Route::get('/circular_edit/{id}', 'CircularController@edit');
    Route::post('/circular_update/{id}', 'CircularController@update');
    Route::post('/circular_update_jury/{type}', 'CircularController@update_jury_member');
    Route::get('/circular_delete/{id}', 'CircularController@circular_delete');


    // Ebook Controller
    Route::get('/writings', 'EbookController@writings');
    Route::get('/ebooks', 'EbookController@index');
    Route::get('/ebooks/{id}', 'EbookController@ebooks');
    Route::post('/ebook_update_jury/{type}', 'EbookController@update_jury_member');
    Route::get('/ebook/generate_pdf/{slug}', 'PublicationController@publication_generate_pdf');


    // EBOOK CREATE - DEPRICATED X
    Route::get('/ebook/{method}/{templete_type}', 'EbookController@ebook_templete');   //  Method: create
    Route::get('/ebook/{method}/{templete_type}/{slug}', 'EbookController@ebook_templete');   //  Method:  edit

    // ebook create/edit with ciruclar
    Route::get('/circular_ebook/{method}/{templete_type}/{circular_slug}', 'EbookController@circular_ebook');   //  Method: create
    Route::get('/circular_ebook/{method}/{templete_type}/{circular_slug}/{slug}', 'EbookController@circular_ebook');   //  Method:  edit


    Route::post('/ebook_store', 'EbookController@ebook_store');

    Route::get('/ebook_edit/{slug}', 'EbookController@ebook_edit');
    Route::put('/ebook_update/{slug}', 'EbookController@ebook_update');
    Route::get('/ebook_delete/{slug}', 'EbookController@ebook_delete');
    Route::POST('/ebook_status_update/{slug}', 'EbookController@ebook_status_update');

    Route::delete('/ebook_delete/{id}', 'EbookController@ebook_delete');


    // Publication Controller
    Route::get('/publications', 'PublicationController@index');
    Route::get('/publication/view/{slug}', 'PublicationController@publication_view');
    Route::get('/publication/generate_pdf/{slug}', 'PublicationController@publication_generate_pdf');


    // Ebook Feedback
    Route::get('/evaluate/{slug}', 'EvaluationController@create');
    Route::post('/evaluate', 'EvaluationController@store');

    Route::get('/evaluations/{slug}', 'EvaluationController@index');


    // Users
    Route::get('/user/create', 'UserController@user_create');
    Route::post('/user/store', 'UserController@store');
    Route::get('/user/{id}', 'UserController@user');

    Route::get('/user/edit/{id}', 'UserController@user_edit');
    Route::post('/user/update/{id}', 'UserController@update');

    Route::get('/users', 'UserController@users');
    Route::get('/users/{type}', 'UserController@users');

    Route::get('/me', 'AdminLoginController@getUser');
    Route::get('logout', 'AdminLoginController@logout')->name('logout');



    // Settings
    Route::get('/settings', 'SettingsController@settings');

    Route::get('/test_jury_auth/{ebook_id}/{jury_id}', 'TestController@jury_auth_check');

});
