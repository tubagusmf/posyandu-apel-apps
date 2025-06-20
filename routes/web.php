<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Kader\KaderController;
use App\Http\Controllers\Bidan\BidanController;
use App\Http\Controllers\Kader\DashboardKaderController;
use App\Http\Controllers\Bidan\DashboardBidanController;
use App\Http\Controllers\Kader\DataIbuController;
use App\Http\Controllers\Kader\DataAnakController;
use App\Http\Controllers\Kader\DataIbuHamilController;
use App\Http\Controllers\Kader\DataKaderController;
use App\Http\Controllers\Kader\DataBidanController;
use App\Http\Controllers\Kader\LayananBalitaController;
use App\Http\Controllers\Kader\LayananIbuHamilController;
use App\Http\Controllers\Kader\LaporanBalitaController;
use App\Http\Controllers\Kader\LaporanIbuHamilController;

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

//Route Data Ibu
Route::middleware('auth:kader')->group(function () {
    Route::get('/kader/data-ibu', [DataIbuController::class, 'index'])->name('kader.data-ibu');
    Route::get('/kader/data-ibu/create', [DataIbuController::class, 'create'])->name('kader.data-ibu.create');
    Route::post('/kader/data-ibu', [DataIbuController::class, 'store'])->name('kader.data-ibu.store');
    Route::get('/kader/data-ibu/{ibu}', [DataIbuController::class, 'show'])->name('kader.data-ibu.show');
    Route::get('/kader/data-ibu/{ibu}/edit', [DataIbuController::class, 'edit'])->name('kader.data-ibu.edit');
    Route::put('/kader/data-ibu/{ibu}', [DataIbuController::class, 'update'])->name('kader.data-ibu.update');
    Route::delete('/kader/data-ibu/{ibu}', [DataIbuController::class, 'destroy'])->name('kader.data-ibu.destroy');
});

//Route Data Anak
Route::middleware('auth:kader')->group(function () {
    Route::get('/kader/data-anak', [DataAnakController::class, 'index'])->name('kader.data-anak');
    Route::get('/kader/data-anak/create', [DataAnakController::class, 'create'])->name('kader.data-anak.create');
    Route::post('/kader/data-anak', [DataAnakController::class, 'store'])->name('kader.data-anak.store');
    Route::get('/kader/data-anak/{anak}', [DataAnakController::class, 'show'])->name('kader.data-anak.show');
    Route::get('/kader/data-anak/{anak}/edit', [DataAnakController::class, 'edit'])->name('kader.data-anak.edit');
    Route::put('/kader/data-anak/{anak}', [DataAnakController::class, 'update'])->name('kader.data-anak.update');
    Route::delete('/kader/data-anak/{anak}', [DataAnakController::class, 'destroy'])->name('kader.data-anak.destroy');
});

//Route Data Ibu Hamil
Route::middleware('auth:kader')->group(function () {
    Route::get('/kader/data-ibu-hamil', [DataIbuHamilController::class, 'index'])->name('kader.data-ibu-hamil');
    Route::get('/kader/data-ibu-hamil/create', [DataIbuHamilController::class, 'create'])->name('kader.data-ibu-hamil.create');
    Route::post('/kader/data-ibu-hamil', [DataIbuHamilController::class, 'store'])->name('kader.data-ibu-hamil.store');
    Route::get('/kader/data-ibu-hamil/{ibuHamil}', [DataIbuHamilController::class, 'show'])->name('kader.data-ibu-hamil.show');
    Route::get('/kader/data-ibu-hamil/{ibuHamil}/edit', [DataIbuHamilController::class, 'edit'])->name('kader.data-ibu-hamil.edit');
    Route::put('/kader/data-ibu-hamil/{ibuHamil}', [DataIbuHamilController::class, 'update'])->name('kader.data-ibu-hamil.update');
    Route::delete('/kader/data-ibu-hamil/{ibuHamil}', [DataIbuHamilController::class, 'destroy'])->name('kader.data-ibu-hamil.destroy');
});

//Route Data Kader
Route::middleware('auth:kader')->group(function () {
    Route::get('/kader/data-kader', [DataKaderController::class, 'index'])->name('kader.data-kader');
    Route::get('/kader/data-kader/create', [DataKaderController::class, 'create'])->name('kader.data-kader.create');
    Route::post('/kader/data-kader', [DataKaderController::class, 'store'])->name('kader.data-kader.store');
    Route::get('/kader/data-kader/{list_kader}', [DataKaderController::class, 'show'])->name('kader.data-kader.show');
    Route::get('/kader/data-kader/{list_kader}/edit', [DataKaderController::class, 'edit'])->name('kader.data-kader.edit');
    Route::put('/kader/data-kader/{list_kader}', [DataKaderController::class, 'update'])->name('kader.data-kader.update');
    Route::delete('/kader/data-kader/{list_kader}', [DataKaderController::class, 'destroy'])->name('kader.data-kader.destroy');
});

//Route Data Bidan
Route::middleware('auth:kader')->group(function () {
    Route::get('/kader/data-bidan', [DataBidanController::class, 'index'])->name('kader.data-bidan');
    Route::get('/kader/data-bidan/create', [DataBidanController::class, 'create'])->name('kader.data-bidan.create');
    Route::post('/kader/data-bidan', [DataBidanController::class, 'store'])->name('kader.data-bidan.store');
    Route::get('/kader/data-bidan/{list_bidan}', [DataBidanController::class, 'show'])->name('kader.data-bidan.show');
    Route::get('/kader/data-bidan/{list_bidan}/edit', [DataBidanController::class, 'edit'])->name('kader.data-bidan.edit');
    Route::put('/kader/data-bidan/{list_bidan}', [DataBidanController::class, 'update'])->name('kader.data-bidan.update');
    Route::delete('/kader/data-bidan/{list_bidan}', [DataBidanController::class, 'destroy'])->name('kader.data-bidan.destroy');
});

//Route Layanan Balita
Route::middleware('auth:kader')->group(function () {
    Route::get('/kader/layanan-balita', [LayananBalitaController::class, 'index'])->name('kader.layanan-balita');
    Route::get('/kader/layanan-balita/create', [LayananBalitaController::class, 'create'])->name('kader.layanan-balita.create');
    Route::post('/kader/layanan-balita', [LayananBalitaController::class, 'store'])->name('kader.layanan-balita.store');
    Route::get('/kader/layanan-balita/{layanan_balita}', [LayananBalitaController::class, 'show'])->name('kader.layanan-balita.show');
    Route::get('/kader/layanan-balita/{layanan_balita}/edit', [LayananBalitaController::class, 'edit'])->name('kader.layanan-balita.edit');
    Route::put('/kader/layanan-balita/{layanan_balita}', [LayananBalitaController::class, 'update'])->name('kader.layanan-balita.update');
    Route::delete('/kader/layanan-balita/{layanan_balita}', [LayananBalitaController::class, 'destroy'])->name('kader.layanan-balita.destroy');
});

//Route Layanan Ibu Hamil
Route::middleware('auth:kader')->group(function () {
    Route::get('/kader/layanan-ibu-hamil', [LayananIbuHamilController::class, 'index'])->name('kader.layanan-ibu-hamil');
    Route::get('/kader/layanan-ibu-hamil/create', [LayananIbuHamilController::class, 'create'])->name('kader.layanan-ibu-hamil.create');
    Route::post('/kader/layanan-ibu-hamil', [LayananIbuHamilController::class, 'store'])->name('kader.layanan-ibu-hamil.store');
    Route::get('/kader/layanan-ibu-hamil/{layanan_ibu_hamil}', [LayananIbuHamilController::class, 'show'])->name('kader.layanan-ibu-hamil.show');
    Route::get('/kader/layanan-ibu-hamil/{layanan_ibu_hamil}/edit', [LayananIbuHamilController::class, 'edit'])->name('kader.layanan-ibu-hamil.edit');
    Route::put('/kader/layanan-ibu-hamil/{layanan_ibu_hamil}', [LayananIbuHamilController::class, 'update'])->name('kader.layanan-ibu-hamil.update');
    Route::delete('/kader/layanan-ibu-hamil/{layanan_ibu_hamil}', [LayananIbuHamilController::class, 'destroy'])->name('kader.layanan-ibu-hamil.destroy');
});

//Route Laporan Balita
Route::middleware('auth:kader')->group(function () {
    Route::get('/kader/laporan-balita', [LaporanBalitaController::class, 'index'])->name('kader.laporan-balita');
});

//Route Laporan Ibu Hamil
Route::middleware('auth:kader')->group(function () {
    Route::get('/kader/laporan-ibu-hamil', [LaporanIbuHamilController::class, 'index'])->name('kader.laporan-ibu-hamil');
});