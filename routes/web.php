<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminPeminjamanController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\landingPage\landingPageController;
use App\Http\Controllers\login\AuthController;
use App\Http\Controllers\user\dashboardController;
use App\Http\Controllers\user\peminjamanController;
use App\Http\Controllers\user\profileController;
use Illuminate\Support\Facades\Route;

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
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/loginPost', [AuthController::class, 'loginPost'])->name('loginPost');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/registerPost', [AuthController::class, 'registerPost'])->name('registerPost');
Route::get('peminjamanAdmin', function () {
    return view('admin/peminjamanAdmin');
});


Route::get('admin/peminjaman/{id}/tolak', [AdminPeminjamanController::class, 'tolakPeminjaman'])->name('admin.peminjaman.tolak');
Route::get('admin/peminjaman/{id}/setuju', [AdminPeminjamanController::class, 'setujuPeminjaman'])->name('admin.peminjaman.setuju');


Route::resource('Admin',AdminController::class);
Route::resource('AdminPeminjaman',AdminPeminjamanController::class);
Route::resource('AdminProfile',AdminProfileController::class);
Route::resource('peminjaman',peminjamanController::class);
Route::resource('profile',profileController::class);
Route::resource('dashboard',dashboardController::class);
Route::get('landingPage',landingPageController::class);


