<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MotorbikeController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\SponsorController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home route
Route::get('/', function () {
    return view('welcome');
});

// ---------------------- Authenticated Routes ----------------------
Route::middleware(['auth'])->group(function () {

    // Admin dashboard
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->role === 'admin') {
            return app(DashboardController::class)->index();
        } elseif ($user->role === 'driver') {
            return redirect()->route('drivers.dashboard');
        } else {
            abort(403, 'Unauthorized');
        }
    })->name('dashboard');

    // Admin CRUD routes
    Route::middleware(['auth'])->group(function () {
        Route::resource('motorbikes', MotorbikeController::class);
        Route::resource('drivers', DriverController::class)->except(['show']); // exclude show to avoid conflict
        Route::resource('sponsors', SponsorController::class);
        Route::resource('contracts', ContractController::class)->only(['index','create','store','destroy','edit']);
        Route::resource('services', ServiceController::class)->only(['index','create','store','destroy','edit']);
        Route::resource('payments', PaymentController::class)->only(['index','create','store','destroy','edit']);
        Route::get('/contracts/{id}/print', [DashboardController::class, 'printContract'])->name('contracts.print');
        Route::get('/contracts/{id}/pdf', [DashboardController::class, 'pdfContract'])->name('contracts.pdf');
    });

    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ---------------------- Driver Routes ----------------------
Route::middleware(['auth'])->prefix('drivers')->name('drivers.')->group(function () {

    // Dashboard route for driver
    Route::get('/dashboard', [DriverController::class, 'dashboard'])->name('dashboard');

    // Driver contracts
    Route::get('/contracts', [DriverController::class, 'contract'])->name('contracts');

    // Driver payments
    Route::post('/payment', [PaymentController::class, 'storeDriverPayment'])->name('payment.store');

    // Optional: other CRUD operations for drivers if needed, but exclude 'show' to prevent conflicts
    Route::resource('/', DriverController::class)->except(['show']);
});

// ---------------------- Authentication ----------------------
require __DIR__.'/auth.php';