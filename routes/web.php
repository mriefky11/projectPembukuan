<?php

use App\Http\Controllers\ActivityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\CategoryCostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\SpendingController;

Route::get('/', fn() => redirect('/login'));
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
   
    Route::middleware('role:operator')->group(function () {
        Route::get('/dashboard/users', [UsersController::class, 'index'])->name('users.index');
        Route::get('/dashboard/users/{id}', [UsersController::class, 'show']);
        Route::get('/dashboard/users/create', [UsersController::class, 'create'])->name('users.create');
        Route::post('/dashboard/users', [UsersController::class, 'store'])->name('users.store');
        Route::get('/dashboard/users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
        Route::put('/dashboard/users/{id}', [UsersController::class, 'update'])->name('users.update');
        Route::delete('/dashboard/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
        Route::get('/dashboard/backup', [BackupController::class, 'index'])->name('backup.index');
        Route::post('/dashboard/backup/run', [BackupController::class, 'run'])->name('backup.run');
    });

    Route::middleware('role:bendahara|kepala_sekolah|yayasan')->group(function () {
        // report routes
        Route::get('/dashboard/report', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/dashboard/report/download/{format}', [LaporanController::class, 'download'])->name('laporan.download');
    });

    Route::middleware('role:bendahara')->group(function () {
        // Activity Routes
        Route::get('/dashboard/activity', [ActivityController::class,'index'])->name('activity.index');
        Route::get('/dashboard/activity/create', [ActivityController::class, 'create'])->name('activity.create');
        Route::get('/dashboard/activity/{id}', [ActivityController::class, 'show']);
        Route::post('/dashboard/activity', [ActivityController::class, 'store'])->name('activity.store');
        Route::get('/dashboard/activity/{id}/edit', [ActivityController::class, 'edit'])->name('activity.edit');
        Route::put('/dashboard/activity/{id}', [ActivityController::class, 'update'])->name('activity.update');
        Route::delete('/dashboard/activity/{id}', [ActivityController::class, 'destroy'])->name('activity.destroy');

        // Category Routes
        Route::get('/dashboard/category', [CategoryCostController::class,'index'])->name('category.index');
        Route::post('/dashboard/category', [CategoryCostController::class,'store'])->name('category.store');
        Route::delete('/dashboard/category/{id}', [CategoryCostController::class,'destroy'])->name('category.destroy');

        // Income Routes
        Route::get('/dashboard/income', [IncomeController::class, 'index'])->name('income.index');
        Route::get('/dashboard/income/create', [IncomeController::class, 'create'])->name('income.create');
        Route::post('/dashboard/income', [IncomeController::class, 'store'])->name('income.store');
        Route::get('/dashboard/income/{income}', [IncomeController::class, 'show'])->name('income.show');
        Route::get('/dashboard/income/{income}/edit', [IncomeController::class, 'edit'])->name('income.edit');
        Route::put('/dashboard/income/{income}', [IncomeController::class, 'update'])->name('income.update');
        Route::delete('/dashboard/income/{id}', [IncomeController::class, 'destroy'])->name('income.destroy');

        // spending Routes
        Route::get('/dashboard/spending', [SpendingController::class, 'index'])->name('spending.index');
        Route::get('/dashboard/spending/create', [SpendingController::class, 'create'])->name('spending.create');
        Route::post('/dashboard/spending', [SpendingController::class, 'store'])->name('spending.store');
        Route::get('/dashboard/spending/{spending}', [SpendingController::class, 'show'])->name('spending.show');
        Route::get('/dashboard/spending/{spending}/edit', [SpendingController::class, 'edit'])->name('spending.edit');
        Route::put('/dashboard/spending/{spending}', [SpendingController::class, 'update'])->name('spending.update');
        Route::delete('/dashboard/spending/{id}', [SpendingController::class, 'destroy'])->name('spending.destroy');
        
        // report routes
        Route::post('/dashboard/report/generate', [LaporanController::class, 'generate'])->name('laporan.generate');
        Route::delete('/dashboard/report/{laporan}', [LaporanController::class, 'destroy'])->name('laporan.destroy');
    });

    

    
});
