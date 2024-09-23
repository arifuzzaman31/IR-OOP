<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AuthNewController;
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

Route::get('/', function () {
    return view('welcome');
});



Route::get('login', function () {
    return view('admin.login');
});


Route::post('login', [AdminLoginController::class, 'login'])->name('login');
Route::view('forgot-password', 'admin.forgot_password')->name('forgot-password');
Route::get('enter-password', [AdminLoginController::class, 'enterPassword'])->name('reset.password.enter');
Route::post('enter-password', [AdminLoginController::class, 'store'])->name('reset.password.enter');


Route::get('forgot-password', [AuthNewController::class, 'forgot_password'])->name('forgot-password');
Route::post('send-reset-mail', [AuthNewController::class, 'resetMail'])->name('send-reset-mail');
Route::get('resetPassword', [AuthNewController::class, 'resetPassword'])->name('reset.password.enter');
Route::post('set-reset-password', [AuthNewController::class, 'set_password'])->name('reset.password.set');



Route::get('/dashboard', function () {
    if (Auth::check()) {
        return redirect(url('admin/dashboard'));
    } else {
        return redirect(url('login'));
    }
});



Route::redirect('/', 'admin/dashboard');
// Route::get('/me', [AdminLoginController::class, 'getUser']);
// Route::get('/dashboard', [AdminLoginController::class, 'index']);
// Route::get('logout', [AdminLoginController::class, 'logout'])->name('logout');
// Route::view('change-password', 'admin.change_password')->name('change-password');
// Route::post('change-password', [AdminLoginController::class, 'changePassword']);




// User - Working Here
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'index']);
// Route::get('/users/{order?}/{pagination?}', [UserController::class, 'index']);
// Route::get('/users/{order}', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);



// Publication
// Route::get('/ebook', [EbookController::class, 'index']);
// Route::get('/ebook/{id}', [EbookController::class, 'index']);
// Route::post('/ebook', [EbookController::class, 'store']);
// Route::put('/ebook/{id}', [EbookController::class, 'update']);
// Route::delete('/ebook/{id}', [EbookController::class, 'destroy']);


// Publication
Route::get('/publication', [PublicationController::class, 'index']);
Route::get('/publication/{id}', [PublicationController::class, 'index']);
Route::post('/publication', [PublicationController::class, 'store']);
Route::put('/publication/{id}', [PublicationController::class, 'update']);
Route::get('/publication_delete/{id}', [PublicationController::class, 'destroy']);

// Test
Route::get('/test_email', [TestController::class, 'test_email']);
Route::get('/counting_jury_pending_review', [TestController::class, 'counting_jury_pending_review']);



// Action Aid URLs
// Route::get('/users', [DemoController::class, 'users']);
// Route::get('/users/{type}', [DemoController::class, 'users']);


// Route::get('/ebooks', [DemoController::class, 'ebooks']);
// Route::get('/ebook/create/{type}', [DemoController::class, 'ebook_templete']);

// Route::get('/settings', [DemoController::class, 'settings']);

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

