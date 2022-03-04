<?php

use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginAttempt'])->name('loginAttempt');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');


Route::group([
    'middleware' => 'auth',
    'prefix' => 'sender',

], function () {
    Route::name('sender')->resource('parcels', ParcelsController::class);
    Route::post('parcels/DTHandler', [ParcelsController::class, 'DTHandler'])->name('sender.parcels.DTHandler');
});

Route::name('sender.')->group(function (){

});
