<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\ExpencesController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\SettlementController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\MemberMiddleware;
use App\Http\Middleware\OwnerMiddleware;
use Illuminate\Support\Facades\Route;



Route::middleware('guest')->group(function () {
    Route::get('registerForm', [LoginController::class, 'showRegisterForm'])->name('showRegisterForm');
    Route::post('/create', [LoginController::class, 'register'])->name('register');
    Route::get('loginForm', [LoginController::class, 'getLogin'])->name('loginForm');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

Route::get('logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/', function () {
    return view('home');
});
Route::post('/settlements/mark-paid/{settlement}', [SettlementController::class, 'markPaid'])
    ->name('settlements.markPaid')
    ->middleware('auth');
Route::get('/home', [RouteController::class, 'home'])->name('home');

Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::patch('/admin/user/{user}/toggle', [AdminController::class, 'toggleUser'])->name('admin.toggleUser');
});

Route::middleware([MemberMiddleware::class])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/colocations', [ColocationController::class, 'index'])->name('colocation.index');
    Route::get('/expences', [ExpencesController::class, 'index'])->name('expenses.index');
    Route::get('/expences/details/{id}', [ExpencesController::class, 'details'])->name('expenses.details');
    Route::get('/settlements', [SettlementController::class, 'index'])->name('settlements.index');
    Route::post('/settlements/create', [SettlementController::class, 'create'])->name('settlements.create');

    Route::get('/invitations/accept/{token}', [InvitationController::class, 'accept'])->name('invite.accept');
    Route::get('/invitations/decline/{token}', [InvitationController::class, 'decline'])->name('invite.decline');
    Route::get('/leave/{id}', [ColocationController::class, 'leave'])->name('leave.colocation');
});


Route::middleware([OwnerMiddleware::class])->group(function () {});

Route::post('/expenses/store', [ExpencesController::class, 'store'])->name('expenses.store');
Route::get('/colocation/create', [ColocationController::class, 'create'])->name('colocations.create');
Route::post('/colocation/save', [ColocationController::class, 'save'])->name('colocations.save');
Route::get('cancel/{colocation}', [ColocationController::class, 'cancel'])->name('cancel');

Route::get('/create/category', [CategoryController::class, 'create'])->name('create.category');
Route::post('/categories/store/{colocation}', [CategoryController::class, 'store'])->name('categories.store');

Route::get('/invite/invitation/{colocation}', [InvitationController::class, 'invite'])->name('invite.invitation');
Route::post('/invite/send/{colocation}', [InvitationController::class, 'send'])->name('invite.send');

Route::get('/expences/destroy', [ExpencesController::class, 'destroy'])->name('expenses.destroy');

Route::get('/colocations', [ColocationController::class, 'index'])->name('colocations.index');

Route::post('/colocation/exit',[ColocationController::class, 'exit'])->name('colocation.exit');
