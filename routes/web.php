<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\Dashboard\Blog;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Middleware\UserMiddleware;

Route::get('/', [HomeController::class, 'home']);

Route::middleware(GuestMiddleware::class)->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm']);
    Route::post('/login', [LoginController::class, 'actionLogin']);

    Route::get('/register', [RegisterController::class, 'showRegisterForm']);
    Route::post('/register', [RegisterController::class, 'actionRegister']);
    Route::get('/register/verify/{token}', [VerificationController::class, 'actionVerify']);

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm']);
    Route::post('/forgot-password', [ForgotPasswordController::class, 'actionForgotPassword']);

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetPasswordForm']);
    Route::post('/reset-password/{token}', [ResetPasswordController::class, 'actionResetPassword']);
});

Route::middleware(UserMiddleware::class)->group(function () {
    Route::get('/dashboard/blog-listing', [Blog::class, 'blogListing']);
    Route::post('/logout', [LogoutController::class, 'actionLogout']);
});
