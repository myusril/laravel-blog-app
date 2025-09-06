<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::get('/', [HomeController::class, 'home']);
Route::get('/post/{slug}', [HomeController::class, 'showSinglePost']);

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
    Route::controller(PostController::class)->group(function () {
        Route::get('/dashboard/posts', 'indexPost');
        Route::get('/dashboard/posts/add', 'showAddPostForm');
        Route::post('/dashboard/posts/add', 'actionAddPost');
        Route::get('/dashboard/posts/edit/{id}', 'showEditPostForm');
        Route::post('/dashboard/posts/edit/{id}', 'actionEditPost');
        Route::post('/dashboard/posts/delete/{id}', 'actionDeletePost');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('/dashboard/categories', 'indexCategory');
        Route::get('/dashboard/categories/add', 'showAddCategoryForm');
        Route::post('/dashboard/categories/add', 'actionAddCategory');
        Route::get('/dashboard/categories/edit/{id}', 'showEditCategoryForm');
        Route::post('/dashboard/categories/edit/{id}', 'actionEditCategory');
        Route::post('/dashboard/categories/delete/{id}', 'actionDeleteCategory');
    });

    Route::post('/logout', [LogoutController::class, 'actionLogout']);

    Route::post('/post/{slug}/comment', [CommentController::class, 'store']);
    Route::post('/comment/{id}/reply', [CommentController::class, 'reply']);
});
