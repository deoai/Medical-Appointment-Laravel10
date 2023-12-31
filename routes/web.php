<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
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

Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/', [AuthController::class, 'loginPost']);
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
});

Route::get('/home', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth', 'check.level:admin'])->group(function () {
    //dokter
    Route::get('/admin/dokter', [AdminController::class, 'dokter'])->name('dokter');
    Route::post('/admin/dokter', [AdminController::class, 'dokterPost'])->name('dokter.post');
    Route::get('/admin/dokter/{id}', [AdminController::class, 'dokterUpdate'])->name('dokter.update');
    Route::put('/admin/dokter/{id}', [AdminController::class, 'dokterUpdateProses'])->name('dokter.updateProses');
    Route::delete('/admin/dokter/{id}', [AdminController::class, 'dokterDelete'])->name('dokter.delete');

    //pasien
    Route::get('/admin/pasien', [AdminController::class, 'pasien'])->name('pasien');
    Route::post('/admin/pasien', [AdminController::class, 'pasienPost'])->name('pasien.post');
    Route::get('/admin/pasien/{id}', [AdminController::class, 'pasienUpdate'])->name('pasien.update');
    Route::put('/admin/pasien/{id}', [AdminController::class, 'pasienUpdateProses'])->name('pasien.updateProses');
    Route::delete('/admin/pasien/{id}', [AdminController::class, 'pasienDelete'])->name('pasien.delete');

    //poli
    Route::get('/admin/poli', [AdminController::class, 'poli'])->name('poli');
    Route::post('/admin/poli', [AdminController::class, 'poliPost'])->name('poli.post');
    Route::get('/admin/poli/{id}', [AdminController::class, 'poliUpdate'])->name('poli.update');
    Route::put('/admin/poli/{id}', [AdminController::class, 'poliUpdateProses'])->name('poli.updateProses');
    Route::delete('/admin/poli/{id}', [AdminController::class, 'poliDelete'])->name('poli.delete');

    //obat
    Route::get('/admin/obat', [AdminController::class, 'obat'])->name('obat');
    Route::post('/admin/obat', [AdminController::class, 'obatPost'])->name('obat.post');
    Route::get('/admin/obat/{id}', [AdminController::class, 'obatUpdate'])->name('obat.update');
    Route::put('/admin/obat/{id}', [AdminController::class, 'obatUpdateProses'])->name('obat.updateProses');
    Route::delete('/admin/obat/{id}', [AdminController::class, 'obatDelete'])->name('obat.delete');
});

Route::middleware(['auth', 'check.level:dokter'])->group(function () {
    Route::get('/dokter/jadwal', [DokterController::class, 'jadwal'])->name('jadwal');
    Route::post('/dokter/jadwal', [DokterController::class, 'jadwalPost'])->name('jadwal.post');
    Route::get('/dokter/jadwal/{id}', [DokterController::class, 'jadwalUpdate'])->name('jadwal.update');
    Route::put('/dokter/jadwal/{id}', [DokterController::class, 'jadwalUpdateProses'])->name('jadwal.updateProses');
    Route::delete('/dokter/jadwal/{id}', [DokterController::class, 'jadwalDelete'])->name('jadwal.delete');
    Route::get('/dokter/periksa', [DokterController::class, 'periksa'])->name('periksa');
});
Route::middleware(['auth', 'check.level:pasien'])->group(function () {
    Route::get('/pasien/poli', [PasienController::class, 'poli'])->name('daftarpoli');
    Route::post('/pasien/poli', [PasienController::class, 'poliPost'])->name('daftarpoli.post');
});
