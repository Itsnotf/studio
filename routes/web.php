<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MtdPembayaranController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::middleware(['auth', 'verified'])->group(function() {
    Route::middleware(['can:admin'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::put('/change-profile-avatar', [DashboardController::class, 'changeAvatar'])->name('change-profile-avatar');
    Route::delete('/remove-profile-avatar', [DashboardController::class, 'removeAvatar'])->name('remove-profile-avatar');

        Route::resource('user', UserController::class);
        Route::resource('product', ProductController::class);
        Route::resource('paket', PaketController::class);
        Route::resource('metode-pembayaran', MtdPembayaranController::class);
        Route::resource('transaksi', TransaksiController::class);
        Route::post('transaksi', [TransaksiController::class,'store'])->name('transaksi.store');
    });
});
