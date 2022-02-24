<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Util\BookController;

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

// ? Public route

Route::get('/', function(){
    return view('home');
});

// Authenticator config
// ? Registration stuff
Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/register', [RegisterController::class, 'add_new_user'])->name('new_user');

// ? Login stuff
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'auth_user'])->name('auth_user');

// ? Logout
Route::post('/logout', [LogoutController::class, 'signoff'])->name('logout');

// New book config
Route::get('/add_new', [BookController::class, 'new_book'])->name('add_new');
Route::post('/add_new', [BookController::class, 'add_book_to_db'])->name('push_to_db');

// Protected routes config
// ? Dashboard stuff
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::post('/dashboard', [DashboardController::class, 'search'])->name('search');
Route::get('/dashboard/{id}', [DashboardController::class, 'view_book'])->name('view_book');
Route::get('/dashboard/delete/{id}', [DashboardController::class, 'remove_book']);
Route::get('/dashboard/edit/{id}', [DashboardController::class, 'edit']);
Route::post('/dashboard/edit/db/{id}', [DashboardController::class, 'to_edit']);

// ! Splash stuff: just about useless!  
Route::get('/book_success', function(){
    return view('extra.success');
})->name('book_success');

Route::get('/registration_success', function(){
    return view('extra.reg_success');
})->name('reg_success');

Route::get('/registration_fail', function(){
    return view('extra.reg_fail');
})->name('reg_fail');


