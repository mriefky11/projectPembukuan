<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthController::class,'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class,'login'])->name('login.submit');
Route::post('/logout', [AuthController::class,'logout'])->name('logout');

Route::get('/dashboard/bendahara', fn()=> "Dashboard Bendahara")->name('dashboard.bendahara')->middleware('auth');
Route::get('/dashboard/kepala', fn()=> "Dashboard Kepala Sekolah")->name('dashboard.kepala')->middleware('auth');
Route::get('/dashboard/yayasan', fn()=> "Dashboard Yayasan")->name('dashboard.yayasan')->middleware('auth');
Route::get('/dashboard/operator', fn()=> "Dashboard Operator")->name('dashboard.operator')->middleware('auth');


