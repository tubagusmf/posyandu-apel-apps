<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Kader\KaderController;
use App\Http\Controllers\Bidan\BidanController;
use App\Http\Controllers\Kader\DashboardKaderController;
use App\Http\Controllers\Bidan\DashboardBidanController;

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
    return view('index');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/login-kader', [KaderController::class, 'showLogin']);
Route::post('login-kader', [KaderController::class, 'login']);
Route::get('/login-bidan', [BidanController::class, 'showLogin']);
Route::post('/login-bidan', [BidanController::class, 'login']);

Route::get('register-kader', [KaderController::class, 'showRegister']);
Route::post('register-kader', [KaderController::class, 'register']);
Route::get('/register-bidan', [BidanController::class, 'showRegister']);
Route::post('/register-bidan', [BidanController::class, 'register']);

Route::get('/logout-kader', function () {
    Session::forget('kader');
    return redirect('/')->with('success', 'Berhasil logout');
})->name('logout.kader');

Route::get('/logout-bidan', function () {
    Session::forget('bidan');
    return redirect('/')->with('success', 'Berhasil logout');
})->name('logout.bidan');

Route::middleware('auth:kader')->group(function () {
    Route::get('/dashboard-kader', [DashboardKaderController::class, 'index'])->name('dashboard.kader');
});

Route::middleware('auth:bidan')->group(function () {
    Route::get('/dashboard-bidan', [DashboardBidanController::class, 'index'])->name('dashboard.bidan');
});