<?php

use App\Http\Controllers\OTPController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\TodoController;

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

// Route::controller(TodoController::class)->group(function () {
//     Route::get('/', 'index')->name('index');
// })->middleware(['auth']);

Route::group(['middleware' => ['auth']], function () {
    Route::controller(TodoController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/storeTask', 'storeTask')->name('storeTask');
        Route::post('/destroyTask', 'destroyTask')->name('destroyTask');
        Route::get('/editTask', 'editTask')->name('editTask');
        Route::put('/updateTask', 'updateTask')->name('UpdateTask');
    });
    
    Route::controller(UserAuthController::class)->group(function () {
        Route::post('/logout', 'logout')->name('auth.logout');
    });
});

Route::controller(UserAuthController::class)->group(function() {
    Route::get('/login', 'form')->name('auth.form');
    Route::post('/register', 'register_account')->name('auth.register'); //also send otp
    Route::post('/login', 'login')->name('auth.login');
});

Route::controller(OTPController::class)->group(function() {
    Route::get('/register/AccountActivation', 'index')->name('auth.AccountActivation');
    Route::post('/register/validatingOTP', 'validatingOTP')->name('auth.validatingOTP');
});