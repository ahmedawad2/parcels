<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Biker\OrdersController;
use App\Http\Controllers\Sender\ParcelsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('login', [AuthController::class, 'login'])
    ->name('login');
Route::post('login', [AuthController::class, 'loginAttempt'])
    ->name('loginAttempt');
Route::get('logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('dashboard', [AuthController::class, 'dashboard'])
    ->name('dashboard')
    ->middleware('auth');


Route::group([
    'middleware' => [
        'auth',
        'sender'
    ],
    'prefix' => 'sender',
], function () {
    Route::name('sender')->resource('parcels', ParcelsController::class);
    Route::post('parcels/DTHandler', [ParcelsController::class, 'DTHandler'])
        ->name('sender.parcels.DTHandler');
});


Route::group([
    'middleware' => [
        'auth',
        'biker'
    ],
    'prefix' => 'biker',
], function () {
    Route::post('orders/cancel', [OrdersController::class, 'cancel'])
        ->name('biker.orders.cancel');
    Route::post('orders/progress', [OrdersController::class, 'progress'])
        ->name('biker.orders.progress');
    Route::name('biker')->resource('parcels', \App\Http\Controllers\Biker\ParcelsController::class);
    Route::post('parcels/DTHandler', [\App\Http\Controllers\Biker\ParcelsController::class, 'DTHandler'])
        ->name('biker.parcels.DTHandler');
    Route::name('biker')->resource('orders', OrdersController::class);
    Route::post('parcels/reserveParcel', [\App\Http\Controllers\Biker\ParcelsController::class, 'reserveParcel'])
        ->name('biker.parcels.reserveParcel');
    Route::post('orders/DTHandler', [OrdersController::class, 'DTHandler'])
        ->name('biker.orders.DTHandler');
});

Route::get('notFound', function () {
    return view('Admin.Errors.404');
})->name('404');

