<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.registeration');
});

Route::get('/', function () {
    if (!session()->has('auth_token')) {
        return redirect('/login')->with('error', 'Session expired. Please log in again.');
    }
    return redirect()->route('dashboard');
});

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['verify.session.token'])->group(function () {
    Route::get('/dashboard', function () {
        return view('home');
    })->name('dashboard');
});


Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');