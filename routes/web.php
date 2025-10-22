<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\RoleController as AdminRoleController;
use App\Http\Controllers\Admin\TicketController as AdminTicketController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Agent\AgentTicketController;
use App\Http\Controllers\Customer\TicketController as CustomerTicketController;
use App\Http\Controllers\TicketCommentController;
use App\Http\Controllers\Customer\CartController;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Public / Guest Routes
|--------------------------------------------------------------------------
*/

// Landing page — show first 2 products
Route::get('/', function () {
    $products = Product::take(2)->get();
    return view('welcome', compact('products'));
})->name('welcome');

// Full shop page — show all products
Route::get('/shop', function () {
    $products = Product::all();
    return view('shop.index', compact('products'));
})->name('shop.index');

// Knowledge Base page
Route::get('/knowledge-base', function () {
    return view('knowledge-base');
})->name('knowledge-base');

// Guest routes (Login, Register, Forgot Password)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

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

    // Welcome first page after login
    Route::get('/welcome-first', fn() => view('welcome_first'))->name('welcome_first');

    // Logout → redirect to HOME PAGE instead of login
    Route::post('/logout', function () {
        auth()->logout();
        return redirect()->route('welcome')->with('success', 'You have been logged out.');
    })->name('logout');

    // Role-based redirect for /tickets
    Route::get('/tickets', function () {
        $user = auth()->user();
        return match (true) {
            $user->hasRole('admin') => redirect()->route('admin.tickets.index'),
            $user->hasRole('agent') => redirect()->route('agent.tickets.index'),
            default => redirect()->route('customer.tickets.index'),
        };
    })->name('tickets.redirect');

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', fn() => view('dashboard.admin'))->name('dashboard');

        Route::resource('users', AdminUserController::class)->except(['create', 'store']);
        Route::resource('roles', AdminRoleController::class)->except(['create', 'store']);
        Route::resource('tickets', AdminTicketController::class)->only(['index', 'show', 'update', 'destroy']);
        Route::resource('products', AdminProductController::class)->only(['index', 'show', 'update', 'destroy']);
        Route::resource('orders', AdminOrderController::class)->only(['index', 'show', 'update', 'destroy']);
    });

    /*
    |--------------------------------------------------------------------------
    | Agent Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:agent')->prefix('agent')->name('agent.')->group(function () {
        Route::get('/dashboard', fn() => view('dashboard.agent'))->name('dashboard');

        Route::get('/tickets', [AgentTicketController::class, 'index'])->name('tickets.index');
        Route::get('/tickets/{ticket}', [AgentTicketController::class, 'show'])->name('tickets.show');
        Route::post('/tickets/{ticket}/update-status', [AgentTicketController::class, 'updateStatus'])->name('tickets.updateStatus');
        Route::post('/tickets/{ticket}/add-internal-note', [AgentTicketController::class, 'addInternalNote'])->name('tickets.addInternalNote');
    });

    /*
    |--------------------------------------------------------------------------
    | Customer Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:customer')->prefix('customer')->name('customer.')->group(function () {
        Route::get('/dashboard', fn() => view('dashboard.customer'))->name('dashboard');

        // Tickets
        Route::get('/tickets', [CustomerTicketController::class, 'index'])->name('tickets.index');
        Route::get('/tickets/create', [CustomerTicketController::class, 'create'])->name('tickets.create');
        Route::post('/tickets', [CustomerTicketController::class, 'store'])->name('tickets.store');
        Route::get('/tickets/{ticket}', [CustomerTicketController::class, 'show'])->name('tickets.show');

        // Gift Shop
        Route::get('/shop', function () {
            $products = Product::all();
            return view('shop.index', compact('products'));
        })->name('shop.index');

        // Cart system
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
        Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

        // Orders page
        Route::get('/orders', fn() => view('customer.orders'))->name('orders.index');
    });

    /*
    |--------------------------------------------------------------------------
    | Shared / Common Routes
    |--------------------------------------------------------------------------
    */
    Route::post('/tickets/{ticket}/comment', [TicketCommentController::class, 'store'])->name('tickets.comment');
});
