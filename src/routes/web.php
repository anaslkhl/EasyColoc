<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ExpencesController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\settlementController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});




Route::get('/home', [RouteController::class, 'home'])->name('home');
Route::get('/admin', [RouteController::class, 'admin']);
Route::get('/dashboard', [RouteController::class, 'dashboard']);
Route::get('/colocations', [ColocationController::class, 'index'])->name('colocation.index');
Route::get('/balances', [RouteController::class, 'balances']);
Route::get('registerForm', [LoginController::class, 'showRegisterForm'])->name('showRegisterForm');
Route::post('/create', [LoginController::class, 'register'])->name('register');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('loginForm', [LoginController::class, 'getLogin'])->name('loginForm');
Route::get('/login', [LoginController::class, 'login'])->name('login');

// Route::get('/colocation/index', [ColocationController::class, 'index'])->name('colocations.index');
Route::get('/colocation/create', [ColocationController::class, 'create'])->name('colocations.create');
Route::post('/colocation/save', [ColocationController::class, 'save'])->name('colocations.save');
// Route::post('/colocation/store', [ColocationController::class, 'store'])->name('colocations.store');
Route::get('/colocation/show', [ColocationController::class, 'index'])->name('colocations.index');
Route::get('cancel/{colocation}', [ColocationController::class, 'cancel'])->name('cancel');
Route::get('/create/category', [CategoryController::class, 'create'])->name('create.category');
Route::post('/create/exponse', [CategoryController::class, 'create'])->name('create.exponse');

Route::get('/invite/invitation/{colocation}', [InvitationController::class, 'invite'])->name('invite.invitation');

Route::post('/invite/send/{colocation}', [InvitationController::class, 'send'])->name('invite.send');

Route::get('/invitations/accept/{token}', [InvitationController::class, 'accept'])->name('invite.accept');
Route::get('/invitations/decline/{token}', [InvitationController::class, 'decline'])->name('invite.decline');
Route::get('/leave/{id}', [ColocationController::class, 'leave'])->name('leave.colocation');

Route::get('/expences', [ExpencesController::class, 'index'])->name('expenses.index');
Route::get('/expences/details/{id}', [ExpencesController::class, 'details'])->name('expenses.details');

Route::post('/expenses/store', [ExpencesController::class, 'store'])->name('expenses.store');

Route::get('/expences/destroy', [ExpencesController::class, 'destroy'])->name('expenses.destroy');

Route::post('/categories/store/{colocation}', [CategoryController::class, 'store'])->name('categories.store');

Route::get('/settlements', [settlementController::class, 'index'])->name('settlements.index');
Route::post('/settlements/create', [settlementController::class, 'create'])->name('settlements.create');

// Route::middleware(['auth', 'owner'])->group(function () {
// });
