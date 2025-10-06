<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\RoleController as AdminRoleController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Agent\TicketController as AgentTicketController;
use App\Http\Controllers\Customer\TicketController as CustomerTicketController;
use App\Http\Controllers\TicketCommentController;

/*
|--------------------------------------------------------------------------
| Public / Guest Routes
|--------------------------------------------------------------------------
*/

// Landing page
Route::get('/', fn() => view('welcome'))->name('welcome');

// Guest routes
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Registration
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Forgot / Reset Password
    Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // First-login welcome page
    Route::get('/welcome-first', fn() => view('welcome_first'))->name('welcome_first');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {

        // Dashboard
        Route::get('/dashboard', fn() => view('dashboard.admin'))->name('dashboard');

        // Users
        Route::resource('users', AdminUserController::class)->except(['create', 'store']);

        // Roles
        Route::resource('roles', AdminRoleController::class)->except(['create', 'store']);

        // Tickets
        Route::resource('tickets', AdminTicketController::class)->only(['index', 'show', 'update', 'destroy']);

        // Products
        Route::resource('products', AdminProductController::class)->only(['index', 'show', 'update', 'destroy']);

        // Orders
        Route::resource('orders', AdminOrderController::class)->only(['index', 'show', 'update', 'destroy']);
    });

    /*
    |--------------------------------------------------------------------------
    | Agent Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:agent')->prefix('agent')->name('agent.')->group(function () {
        Route::get('/dashboard', fn() => view('dashboard.agent'))->name('dashboard');

        // Tickets assigned to agent
        Route::get('/tickets', [AgentTicketController::class, 'index'])->name('tickets.index');
        Route::get('/tickets/{ticket}', [AgentTicketController::class, 'show'])->name('tickets.show');
    });

    /*
    |--------------------------------------------------------------------------
    | Customer Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:customer')->prefix('customer')->name('customer.')->group(function () {
        Route::get('/dashboard', fn() => view('dashboard.customer'))->name('dashboard');

        // Tickets created by customer
        Route::get('/tickets', [CustomerTicketController::class, 'index'])->name('tickets.index');
        Route::get('/tickets/create', [CustomerTicketController::class, 'create'])->name('tickets.create');
        Route::post('/tickets', [CustomerTicketController::class, 'store'])->name('tickets.store');
        Route::get('/tickets/{ticket}', [CustomerTicketController::class, 'show'])->name('tickets.show');
    });

    /*
    |--------------------------------------------------------------------------
    | Shared / Common Routes
    |--------------------------------------------------------------------------
    */
    // Ticket comments (agents + customers)
    Route::post('/tickets/{ticket}/comment', [TicketCommentController::class, 'store'])->name('tickets.comment');
});
