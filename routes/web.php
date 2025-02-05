<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\WalletController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/', [MainController::class, 'welcome'])->name('welcome');

Route::get('/register', [UserController::class, 'RegForm'])->name('register');
Route::post('/register', [UserController::class, 'register'])->name('register');

Route::get('/login', [UserController::class, 'LogForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::get('/main', [MainController::class, 'main'])->middleware('auth')->name('main');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');


Route::get('/email/verify', function () {
    return view('auth.verify-email'); 
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/main');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/resend', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('resent', true);
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

Route::get('/cities/{country_id}', [CityController::class, 'getCities']);

Route::get('/contact', [MainController::class, 'contact'])->name('contact.form');

Route::post('/contact/send', [MainController::class, 'send'])->name('contact.send');

Route::get('/contact/submitted', function () {
    return view('contactsub');
})->name('contact.submitted');

Route::get('/wallet', [WalletController::class, 'walletInfo'])->middleware('auth')->name('wallet');

Route::get('/currency-converter', [WalletController::class, 'currencyConverter'])->name('currency.converter');
Route::post('/convert-currency', [WalletController::class, 'convertCurrency'])->name('convert.currency');

Route::get('/link-card', [WalletController::class, 'linkCardForm'])->middleware('auth')->name('link.card');
Route::post('/add-card', [WalletController::class, 'addCard'])->middleware('auth')->name('add.card');
