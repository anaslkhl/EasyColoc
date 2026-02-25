<?php

use App\Http\Controllers\ColocationController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});




Route::get('/home', [RouteController::class, 'home']);
Route::get('/admin', [RouteController::class, 'admin']);
Route::get('/dashboard', [RouteController::class, 'dashboard']);
Route::get('/expences', [RouteController::class, 'expences']);
Route::get('/colocations', [RouteController::class, 'colocations']);
Route::get('/balances', [RouteController::class, 'balances']);
Route::get('registerForm', [LoginController::class, 'showRegisterForm'])->name('showRegisterForm');
Route::post('/create', [LoginController::class, 'register'])->name('register');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('loginForm', [LoginController::class, 'getLogin'])->name('loginForm');
Route::get('/login', [LoginController::class, 'login'])->name('login');

Route::get('/colocation/index', [ColocationController::class, 'index'])->name('colocations.index');
Route::get('/colocation/create', [ColocationController::class, 'create'])->name('colocations.create');
Route::post('/colocation/save', [ColocationController::class, 'save'])->name('colocations.save');