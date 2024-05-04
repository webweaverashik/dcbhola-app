<?php

use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\SectionController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect('dashboard');
    });
});


Route::controller(AuthenticateController::class)->group(function(){
    // Route::get('/registration','registration')->middleware('alreadyLoggedIn');
    // Route::post('/registration-user','registerUser')->name('register-user');
    Route::get('/login','login')->middleware('alreadyLoggedIn');
    Route::post('/login','loginUser')->name('login');
    Route::get('/dashboard','dashboard')->middleware('isLoggedIn');
    Route::get('/logout','logout');

    Route::get('/letters', [LetterController::class, 'index']);
    Route::get('/letters/add', [LetterController::class, 'create']);
    Route::post('/letters/add', [LetterController::class, 'store']);


    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/profile', [UserController::class, 'profileView']);

    Route::get('/sections', [SectionController::class, 'index']);
});