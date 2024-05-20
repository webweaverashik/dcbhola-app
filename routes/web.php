<?php

use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LetterController;
use App\Http\Controllers\SectionController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\Letter;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    Route::get('/login','login')->middleware('alreadyLoggedIn');
    Route::post('/login','loginUser')->name('login');
    Route::get('/logout','logout');
    
    
    Route::middleware('isLoggedIn')->group(function (){
        Route::get('/dashboard', [DashboardController::class, 'index']);

        Route::get('/letters', [LetterController::class, 'index']);
        Route::get('/letters/create', [LetterController::class, 'create']);
        Route::get('/letters/{id}/edit', [LetterController::class, 'edit']);
        Route::post('/letters/create', [LetterController::class, 'store']);
        Route::put('/letters/{id}/edit', [LetterController::class, 'update']);
        Route::get('/letters/{id}/delete', [LetterController::class, 'destroy']);
        Route::get('/letters/ajax/{id}', [LetterController::class, 'ajaxLetterInfo']);


        Route::get('/users', [UserController::class, 'index']);
        Route::get('/users/profile', [UserController::class, 'edit']);
        Route::put('/users/profile', [UserController::class, 'update']);
        Route::put('/users/profile/password', [UserController::class, 'passwordUpdate']);
        Route::get('/users/{id}/delete', [UserController::class, 'destroy']);

        Route::post('/users/add/officer', [UserController::class, 'addOfficer']);
        Route::post('/users/add/staff', [UserController::class, 'addStaff']);

        Route::put('/users/edit/officer', [UserController::class, 'updateOfficer']);
        Route::put('/users/edit/staff', [UserController::class, 'updateStaff']);

        Route::get('/users/ajax/{id}', [UserController::class, 'ajaxUserInfo']);
        
        
        Route::get('/sections', [SectionController::class, 'index']);
        Route::post('/sections/add', [SectionController::class, 'store']);
        Route::put('/sections/edit', [SectionController::class, 'update']);
        Route::get('/sections/ajax/{id}', [SectionController::class, 'fetch']);
    });

});