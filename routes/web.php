<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Middleware\IsAdmin;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard (Admin + Staff)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile (Admin + Staff)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| CUSTOMER EXPORTS (ADMIN ONLY)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', IsAdmin::class])->group(function () {

    Route::get('customers/export/csv', [CustomerController::class, 'exportCsv'])
        ->name('customers.export.csv');

    Route::get('customers/export/pdf', [CustomerController::class, 'exportPdf'])
        ->name('customers.export.pdf');
});

/*
|--------------------------------------------------------------------------
| CUSTOMERS
|--------------------------------------------------------------------------
*/

/*
| IMPORTANT:
| Put CREATE route BEFORE {customer}
| Otherwise Laravel thinks "create" is a customer ID.
*/

/* Admin Only */
Route::middleware(['auth', IsAdmin::class])->group(function () {

    Route::get('customers/create', [CustomerController::class, 'create'])
        ->name('customers.create');

    Route::post('customers', [CustomerController::class, 'store'])
        ->name('customers.store');

    Route::get('customers/{customer}/edit', [CustomerController::class, 'edit'])
        ->name('customers.edit');

    Route::put('customers/{customer}', [CustomerController::class, 'update'])
        ->name('customers.update');

    Route::delete('customers/{customer}', [CustomerController::class, 'destroy'])
        ->name('customers.destroy');
});

/* Staff + Admin (Read Only) */
Route::middleware(['auth'])->group(function () {

    Route::get('customers', [CustomerController::class, 'index'])
        ->name('customers.index');

    Route::get('customers/{customer}', [CustomerController::class, 'show'])
        ->name('customers.show');
});

/*
|--------------------------------------------------------------------------
| ORDERS
|--------------------------------------------------------------------------
*/

/* Admin Only */
Route::middleware(['auth', IsAdmin::class])->group(function () {

    Route::get('orders/create', [OrderController::class, 'create'])
        ->name('orders.create');

    Route::post('orders', [OrderController::class, 'store'])
        ->name('orders.store');

    Route::get('orders/{order}/edit', [OrderController::class, 'edit'])
        ->name('orders.edit');

    Route::put('orders/{order}', [OrderController::class, 'update'])
        ->name('orders.update');

    Route::delete('orders/{order}', [OrderController::class, 'destroy'])
        ->name('orders.destroy');
});

/* Staff + Admin */
Route::middleware(['auth'])->group(function () {

    Route::get('orders', [OrderController::class, 'index'])
        ->name('orders.index');

    Route::get('orders/{order}', [OrderController::class, 'show'])
        ->name('orders.show');
});

/*
|--------------------------------------------------------------------------
| ADMIN ONLY (Future)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', IsAdmin::class])->group(function () {

    // Route::get('/activity-logs', [ActivityLogController::class, 'index']);

});

require __DIR__.'/auth.php';
