<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

// Rute untuk UserController
Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
Route::get('/user/create', [UserController::class, 'create']);
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');

// Rute untuk ProfileController
Route::get('/profile', [ProfileController::class, 'profile']);
Route::get('/profile/{nama}/{kelas}/{npm}', [ProfileController::class, 'profile']);
Route::post('/profile/upload', [ProfileController::class, 'uploadProfilePicture'])->name('upload.profile.picture');
