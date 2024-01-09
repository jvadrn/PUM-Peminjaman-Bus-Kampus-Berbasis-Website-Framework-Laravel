<?php

use App\Http\Controllers\landingPage\landingPageController;
use App\Http\Controllers\login\userLoginController;
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
Route::post('/loginPost', [userLoginController::class, 'loginPost'])->name('loginPost');
Route::get('/login',[userLoginController::class,'login'])->name('login');



Route::get('/register',[userLoginController::class,'register'])->name('register');
Route::post('/registerPost',[userLoginController::class,'registerPost'])->name('registerPost');



Route::middleware(['auth', 'filter.data.by.user.id'])->resource('peminjaman', 'peminjamanController');

Route::get('peminjamanAdmin', function () {
    return view('admin/peminjamanAdmin');
});
Route::get('profileAdmin', function () {
    return view('admin/profileAdmin');
});
Route::get('indexAdmin', function () {
    return view('admin/indexAdmin');
});






Route::resource('peminjaman',peminjamanController::class);
Route::resource('profile',profileController::class);
Route::resource('dashboard',dashboardController::class);
Route::get('landingPage',landingPageController::class);


