<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\TicketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| Routes are grouped by middleware for guest (unauthenticated) and 
| auth (authenticated) users.
|
*/

// Landing / Welcome page for all users
Route::get('/', function () {
    return view('welcome'); // Your landing page Blade
})->name('welcome');

// --------------------
// Guest Routes
// Only accessible if NOT logged in
// --------------------
Route::middleware('guest')->group(function () {

    // Login routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Registration routes
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/tickets/{ticket}/comment', [TicketCommentController::class, 'store'])
    ->name('tickets.comment')
    ->middleware('auth');

});

// --------------------
// Authenticated Routes
// Only accessible if logged in
// --------------------
Route::middleware('auth')->group(function () {

    // Dashboard route (optional: redirects to tickets)
    Route::get('/dashboard', function () {
        return redirect()->route('tickets.index'); // Redirect to tickets dashboard
    })->name('dashboard');

    // Ticket routes
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
