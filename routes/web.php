<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketCommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing / Welcome page
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// --------------------
// Guest Routes
// --------------------
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Register
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Forgot / Reset Password
    Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

// --------------------
// Authenticated Routes
// --------------------
Route::middleware('auth')->group(function () {
    // First-login welcome
    Route::get('/welcome-first', function () {
        return view('welcome_first');
    })->name('welcome_first');

    // Dashboard
    Route::get('/dashboard', function () {
        return redirect()->route('tickets.index');
    })->name('dashboard');

    // Tickets
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');

    // Ticket comments
    Route::post('/tickets/{ticket}/comment', [TicketCommentController::class, 'store'])->name('tickets.comment');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
