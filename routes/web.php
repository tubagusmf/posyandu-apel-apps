<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Kader\KaderController;
use App\Http\Controllers\Bidan\BidanController;
use App\Http\Controllers\Kader\DashboardKaderController;
use App\Http\Controllers\Bidan\DashboardBidanController;
use App\Http\Controllers\Kader\DataAnakController;
use App\Http\Controllers\Kader\DataIbuHamilController;
use App\Http\Controllers\Kader\DataKaderController;
use App\Http\Controllers\Kader\DataBidanController;
use App\Http\Controllers\Kader\LayananBalitaController;
use App\Http\Controllers\Kader\LayananIbuHamilController;
use App\Http\Controllers\Kader\LaporanBalitaController;
use App\Http\Controllers\Kader\LaporanIbuHamilController;
use App\Http\Controllers\Kader\RujukanKaderController;
use App\Http\Controllers\Kader\ProfileKaderController;
use App\Http\Controllers\Bidan\LaporanBalitaBidanController;
use App\Http\Controllers\Bidan\LaporanIbuHamilBidanController;
use App\Http\Controllers\Bidan\RujukanBidanController;
use App\Http\Controllers\Bidan\ProfileBidanController;

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
})->name('login');

Route::get('/register', function () {
    return view('register');
});

Route::get('/login-kader', [KaderController::class, 'showLogin'])->name('login.kader');
Route::post('login-kader', [KaderController::class, 'login']);
Route::get('/login-bidan', [BidanController::class, 'showLogin'])->name('login.bidan');
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
    Route::get('/kader/layanan-balita/cluster', [LayananBalitaController::class, 'clusterGizi'])->name('kader.layanan-balita.cluster');
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

//Route Rujukan Kader
Route::middleware('auth:kader')->group(function () {
    Route::get('/kader/rujukan-kader', [RujukanKaderController::class, 'index'])->name('kader.rujukan-kader');
    Route::get('/kader/rujukan-kader/create/{rujukan}', [RujukanKaderController::class, 'create'])->name('kader.rujukan-kader.create');
    Route::post('/kader/rujukan-kader', [RujukanKaderController::class, 'store'])->name('kader.rujukan-kader.store');
    Route::get('/kader/rujukan-kader/data-rujukan', [RujukanKaderController::class, 'dataRujukan'])->name('kader.rujukan-kader.data-rujukan');
    Route::get('/kader/rujukan-kader/{rujukan}/edit', [RujukanKaderController::class, 'edit'])->name('kader.rujukan-kader.edit');
    Route::put('/kader/rujukan-kader/{rujukan}', [RujukanKaderController::class, 'update'])->name('kader.rujukan-kader.update');
    Route::delete('/kader/rujukan-kader/{rujukan}', [RujukanKaderController::class, 'destroy'])->name('kader.rujukan-kader.destroy');
});

//Route Profile Kader
Route::middleware('auth:kader')->group(function () {
    Route::get('/kader/profile-kader', [ProfileKaderController::class, 'index'])->name('kader.profile-kader');
    Route::get('/kader/profile-kader/edit', [ProfileKaderController::class, 'edit'])->name('kader.profile-kader.edit');
    Route::put('/kader/profile-kader', [ProfileKaderController::class, 'update'])->name('kader.profile-kader.update');
});

//Route Laporan Balita Bidan
Route::middleware('auth:bidan')->group(function () {
    Route::get('/bidan/laporan-balita', [LaporanBalitaBidanController::class, 'index'])->name('bidan.laporan-balita');
    Route::get('/bidan/laporan-balita/export/pdf', [LaporanBalitaBidanController::class, 'exportPdf'])->name('bidan.laporan-balita.export.pdf');
    Route::get('/bidan/laporan-balita/export/excel', [LaporanBalitaBidanController::class, 'exportExcel'])->name('bidan.laporan-balita.export.excel');
});

//Route Laporan Ibu Hamil Bidan
Route::middleware('auth:bidan')->group(function () {
    Route::get('/bidan/laporan-ibu-hamil', [LaporanIbuHamilBidanController::class, 'index'])->name('bidan.laporan-ibu-hamil');
    Route::get('/bidan/laporan-ibu-hamil/export/pdf', [LaporanIbuHamilBidanController::class, 'exportPdf'])->name('bidan.laporan-ibu-hamil.export.pdf');
    Route::get('/bidan/laporan-ibu-hamil/export/excel', [LaporanIbuHamilBidanController::class, 'exportExcel'])->name('bidan.laporan-ibu-hamil.export.excel');
});

//Route Rujukan Bidan
Route::middleware('auth:bidan')->group(function () {
    Route::get('/bidan/rujukan-bidan', [RujukanBidanController::class, 'index'])->name('bidan.rujukan-bidan');
    Route::get('/bidan/rujukan-bidan/{rujukan}/download/pdf', [RujukanBidanController::class, 'downloadPdf'])->name('bidan.rujukan-bidan.download.pdf');
    Route::get('/bidan/rujukan-bidan/{rujukan}/print/pdf', [RujukanBidanController::class, 'printPdf'])->name('bidan.rujukan-bidan.print.pdf');
});

//Route Profile Bidan
Route::middleware('auth:bidan')->group(function () {
    Route::get('/bidan/profile-bidan', [ProfileBidanController::class, 'index'])->name('bidan.profile-bidan');
    Route::get('/bidan/profile-bidan/edit', [ProfileBidanController::class, 'edit'])->name('bidan.profile-bidan.edit');
    Route::put('/bidan/profile-bidan', [ProfileBidanController::class, 'update'])->name('bidan.profile-bidan.update');
});