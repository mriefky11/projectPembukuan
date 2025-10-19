<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/', fn() => redirect('/login'));
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware(['auth', 'role:operator'])->group(function () {
        Route::get('/dashboard/users', [UsersController::class, 'index'])->name('users.index');
        Route::get('/dashboard/users/{id}', [UsersController::class, 'show']);
        Route::get('/dashboard/users/create', [UsersController::class, 'create'])->name('users.create');
        Route::post('/dashboard/users', [UsersController::class, 'store'])->name('users.store');
        Route::get('/dashboard/users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
        Route::put('/dashboard/users/{id}', [UsersController::class, 'update'])->name('users.update');
        Route::delete('/dashboard/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
    });
});
