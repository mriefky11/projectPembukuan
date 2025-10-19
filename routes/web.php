<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryCostController;
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

    route::middleware(['auth', 'role:bendahara'])->group(function(){
        Route::get('/dashboard/activity', [ActivityController::class,'index'])->name('activity.index');
        Route::get('/dashboard/activity/create', [ActivityController::class, 'create'])->name('activity.create');
        Route::get('/dashboard/activity/{id}', [ActivityController::class, 'show']);
        Route::post('/dashboard/activity', [ActivityController::class, 'store'])->name('activity.store');
        Route::get('/dashboard/activity/{id}/edit', [ActivityController::class, 'edit'])->name('activity.edit');
        Route::put('/dashboard/activity/{id}', [ActivityController::class, 'update'])->name('activity.update');
        Route::delete('/dashboard/activity/{id}', [ActivityController::class, 'destroy'])->name('activity.destroy');

        Route::get('/dashboard/category', [CategoryCostController::class,'index'])->name('category.index');
        Route::post('/dashboard/category', [CategoryCostController::class,'store'])->name('category.store');
        Route::delete('/dashboard/category/{id}', [CategoryCostController::class,'destroy'])->name('category.destroy');
    });
});
