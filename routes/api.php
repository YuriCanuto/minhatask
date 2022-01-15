<?php

use App\Http\Controllers\Card\CardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Session\{SessionController, ForgotPasswordController, ResetPasswordController};

Route::middleware(['guest:api'])->group(function () {
    Route::post('/login', [SessionController::class, 'login']);
    Route::post('/register', [SessionController::class, 'register']);
    Route::post('/forgot', [ForgotPasswordController::class, 'forgot']);
    Route::get('/reset/{token}/{email}', [ResetPasswordController::class, 'formReset'])->name('password.reset');
    Route::post('/reset', [ResetPasswordController::class, 'reset']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/perfil', [SessionController::class, 'perfil']);
    Route::get('/logout', [SessionController::class, 'logout']);
    Route::post('/card', [CardController::class, 'store']);
});