<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('login', function () {
    return view('admin.login');
});
Route::post('login', 'AdminLoginController@login')->name('login');
Route::view('forgot-password', 'admin.forgot_password')->name('forgot-password');
Route::get('enter-password', 'AdminLoginController@enterPassword')->name('reset.password.enter');
Route::post('enter-password', 'AdminLoginController@store')->name('reset.password.enter');


Route::get('forgot-password', 'AuthNewController@forgot_password')->name('forgot-password');
Route::post('send-reset-mail', 'AuthNewController@resetMail')->name('send-reset-mail');
Route::get('resetPassword', 'AuthNewController@resetPassword')->name('reset.password.enter');
Route::post('set-reset-password', 'AuthNewController@set_password')->name('reset.password.set');



Route::get('/dashboard', function () {
    if (Auth::check()) {
        return redirect(url('admin/dashboard'));
    } else {
        return redirect(url('login'));
    }
});



Route::redirect('/', 'admin/dashboard');
// Route::get('/me', 'AdminLoginController@getUser');
// Route::get('/dashboard', 'AdminLoginController@index');
// Route::get('logout', 'AdminLoginController@logout')->name('logout');
// Route::view('change-password', 'admin.change_password')->name('change-password');
// Route::post('change-password', 'AdminLoginController@changePassword');




// User - Working Here
Route::get('/users', 'UserController@index');
Route::get('/users/{id}', 'UserController@index');
// Route::get('/users/{order?}/{pagination?}', 'UserController@index');
// Route::get('/users/{order}', 'UserController@index');
Route::post('/users', 'UserController@store');
Route::put('/users/{id}', 'UserController@update');
Route::delete('/users/{id}', 'UserController@destroy');



// Publication
// Route::get('/ebook', 'EbookController@index');
// Route::get('/ebook/{id}', 'EbookController@index');
// Route::post('/ebook', 'EbookController@store');
// Route::put('/ebook/{id}', 'EbookController@update');
// Route::delete('/ebook/{id}', 'EbookController@destroy');


// Publication
Route::get('/publication', 'PublicationController@index');
Route::get('/publication/{id}', 'PublicationController@index');
Route::post('/publication', 'PublicationController@store');
Route::put('/publication/{id}', 'PublicationController@update');
Route::get('/publication_delete/{id}', 'PublicationController@destroy');

// Test
Route::get('/test_email', 'TestController@test_email');
Route::get('/counting_jury_pending_review', 'TestController@counting_jury_pending_review');



// Action Aid URLs
// Route::get('/users', 'DemoController@users');
// Route::get('/users/{type}', 'DemoController@users');


// Route::get('/ebooks', 'DemoController@ebooks');
// Route::get('/ebook/create/{type}', 'DemoController@ebook_templete');

// Route::get('/settings', 'DemoController@settings');

Route::get('/cleareverything', function () {
    $clearcache = Artisan::call('config:cache');
    echo "Config Cached<br>";

    $clearcache = Artisan::call('config:clear');
    echo "Config Clear<br>";

    $clearcache = Artisan::call('cache:clear');
    echo "Cache cleared<br>";

    $clearcache = Artisan::call('route:cache');
    echo "Route cleared<br>";

    $clearview = Artisan::call('view:clear');
    echo "View cleared<br>";

    $clearconfig = Artisan::call('config:cache');
    echo "Config cleared<br>";

    // $cleardebugbar = Artisan::call('debugbar:clear');
    // echo "Debug Bar cleared<br>";
});
