<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [UserController::class, 'RegForm'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/login', [UserController::class, 'LogForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::get('/main', [MainController::class, 'main'])->middleware('auth');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');