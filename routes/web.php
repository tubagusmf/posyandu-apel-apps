<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Kader\KaderController;
use App\Http\Controllers\Bidan\BidanController;
use App\Http\Controllers\Kader\DashboardKaderController;
use App\Http\Controllers\Bidan\DashboardBidanController;
use App\Http\Controllers\Kader\DataIbuController;

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

Route::middleware('auth:kader')->group(function () {
    Route::get('/kader/data-ibu', [DataIbuController::class, 'index'])->name('kader.data-ibu');
});
Route::middleware('auth:kader')->group(function () {
    Route::get('/kader/data-ibu/create', [DataIbuController::class, 'create'])->name('kader.data-ibu.create');
    Route::post('/kader/data-ibu', [DataIbuController::class, 'store'])->name('kader.data-ibu.store');
    Route::get('/kader/data-ibu/{ibu}', [DataIbuController::class, 'show'])->name('kader.data-ibu.show');
    Route::get('/kader/data-ibu/{ibu}/edit', [DataIbuController::class, 'edit'])->name('kader.data-ibu.edit');
    Route::put('/kader/data-ibu/{ibu}', [DataIbuController::class, 'update'])->name('kader.data-ibu.update');
    Route::delete('/kader/data-ibu/{ibu}', [DataIbuController::class, 'destroy'])->name('kader.data-ibu.destroy');
});

// Route::prefix('kader')->middleware(['auth:kader'])->group(function () {
//     Route::resource('ibu', \App\Http\Controllers\Kader\DataIbuController::class, ['as' => 'kader']);
// });