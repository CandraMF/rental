<?php

use App\Http\Controllers\Administrasi\AdministrasiPengembalianController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\Member\MemberPenyewaanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\Administrasi\AdministrasiPenyewaanController;
use App\Http\Controllers\Petugas\PetugasKendaraanController;
use App\Http\Controllers\Petugas\PetugasMemberController;
use App\Http\Controllers\Petugas\PetugasPengembalianController;
use App\Http\Controllers\Petugas\PetugasPenyewaanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProfileController;

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
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['role:member'])->prefix('/member')->name('member.')->group(function () {
        Route::get('/', [DashboardController::class, 'member'])->name('dashboard');

        Route::get('/penyewaan', [MemberPenyewaanController::class, 'index'])->name('penyewaan.index');
        Route::get('/penyewaan/create', [MemberPenyewaanController::class, 'create'])->name('penyewaan.create');
        Route::post('/penyewaan/store', [MemberPenyewaanController::class, 'store'])->name('penyewaan.store');
        Route::get('/penyewaan/{id}', [MemberPenyewaanController::class, 'show'])->name('penyewaan.show');
        Route::get('/penyewaan/{id}/edit', [MemberPenyewaanController::class, 'edit'])->name('penyewaan.edit');
        Route::post('/penyewaan/{id}/update', [MemberPenyewaanController::class, 'update'])->name('penyewaan.update');
        Route::delete('/penyewaan/{id}', [MemberPenyewaanController::class, 'destroy'])->name('penyewaan.destroy');
    });

    Route::middleware(['role:petugas'])->prefix('/petugas')->name('petugas.')->group(function () {
        Route::get('/', [DashboardController::class, 'petugas'])->name('dashboard');

        Route::get('/penyewaan', [PetugasPenyewaanController::class, 'index'])->name('penyewaan.index');
        Route::get('/penyewaan/create', [PetugasPenyewaanController::class, 'create'])->name('penyewaan.create');
        Route::post('/penyewaan/store', [PetugasPenyewaanController::class, 'store'])->name('penyewaan.store');
        Route::get('/penyewaan/{id}', [PetugasPenyewaanController::class, 'show'])->name('penyewaan.show');
        Route::get('/penyewaan/{id}/edit', [PetugasPenyewaanController::class, 'edit'])->name('penyewaan.edit');
        Route::post('/penyewaan/{id}/update', [PetugasPenyewaanController::class, 'update'])->name('penyewaan.update');
        Route::delete('/penyewaan/{id}', [PetugasPenyewaanController::class, 'destroy'])->name('penyewaan.destroy');

        Route::get('/penyewaan/changeStatus/{id}/{status}', [PetugasPenyewaanController::class, 'changeStatus'])->name('penyewaan.changeStatus');

        Route::get('/pengembalian', [PetugasPengembalianController::class, 'index'])->name('pengembalian.index');
        Route::post('/pengembalian/{id}/update', [PetugasPengembalianController::class, 'update'])->name('pengembalian.update');

        Route::post('/pengembalian/kembalikan', [PetugasPengembalianController::class, 'kembalikan'])->name('pengembalian.kembalikan');

        Route::get('/kendaraan', [PetugasKendaraanController::class, 'index'])->name('kendaraan.index');
        Route::get('/kendaraan/create', [PetugasKendaraanController::class, 'create'])->name('kendaraan.create');
        Route::post('/kendaraan/store', [PetugasKendaraanController::class, 'store'])->name('kendaraan.store');
        Route::get('/kendaraan/{id}', [PetugasKendaraanController::class, 'show'])->name('kendaraan.show');
        Route::get('/kendaraan/{id}/edit', [PetugasKendaraanController::class, 'edit'])->name('kendaraan.edit');
        Route::post('/kendaraan/{id}/update', [PetugasKendaraanController::class, 'update'])->name('kendaraan.update');
        Route::delete('/kendaraan/{id}', [PetugasKendaraanController::class, 'destroy'])->name('kendaraan.destroy');
        
        Route::get('/member', [PetugasMemberController::class, 'index'])->name('member.index');
        Route::get('/member/create', [PetugasMemberController::class, 'create'])->name('member.create');
        Route::post('/member/store', [PetugasMemberController::class, 'store'])->name('member.store');
        Route::get('/member/{id}', [PetugasMemberController::class, 'show'])->name('member.show');
        Route::get('/member/{id}/edit', [PetugasMemberController::class, 'edit'])->name('member.edit');
        Route::post('/member/{id}/update', [PetugasMemberController::class, 'update'])->name('member.update');
        Route::delete('/member/{id}', [PetugasMemberController::class, 'destroy'])->name('member.destroy');

        Route::get('/member/cetak-kartu/{id}', [PetugasMemberController::class, 'cetakKartu'])->name('member.cetak-kartu');
        
    });
    
    Route::middleware(['role:admin'])->prefix('/admin')->name('admin.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/penyewaan', [AdministrasiPenyewaanController::class, 'index'])->name('penyewaan.index');
        Route::get('/penyewaan/create', [AdministrasiPenyewaanController::class, 'create'])->name('penyewaan.create');
        Route::post('/penyewaan/store', [AdministrasiPenyewaanController::class, 'store'])->name('penyewaan.store');
        Route::get('/penyewaan/{id}', [AdministrasiPenyewaanController::class, 'show'])->name('penyewaan.show');
        Route::get('/penyewaan/{id}/edit', [AdministrasiPenyewaanController::class, 'edit'])->name('penyewaan.edit');
        Route::post('/penyewaan/{id}/update', [AdministrasiPenyewaanController::class, 'update'])->name('penyewaan.update');
        Route::delete('/penyewaan/{id}', [AdministrasiPenyewaanController::class, 'destroy'])->name('penyewaan.destroy');

        Route::get('/penyewaan/cetak-kwitansi/{id}',[AdministrasiPenyewaanController::class, 'cetakKwitansi'])->name('penyewaan.cetak-kwitansi');
        Route::get('/penyewaan/cetak-kwitansi-denda/{id}',[AdministrasiPenyewaanController::class, 'cetakKwitansiDenda'])->name('penyewaan.cetak-kwitansi-denda');
        Route::get('/penyewaan/cetak-laporan/all/{bulan}/{tahun}',[AdministrasiPenyewaanController::class, 'index'])->name('penyewaan.export-excel.all');

        Route::get('/penyewaan/{id}/selesaikan', [AdministrasiPenyewaanController::class, 'selesaikan'])->name('penyewaan.selesaikan');

        Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.index');
        Route::get('/petugas/create', [PetugasController::class, 'create'])->name('petugas.create');
        Route::post('/petugas/store', [PetugasController::class, 'store'])->name('petugas.store');
        Route::get('/petugas/{id}', [PetugasController::class, 'show'])->name('petugas.show');
        Route::get('/petugas/{id}/edit', [PetugasController::class, 'edit'])->name('petugas.edit');
        Route::post('/petugas/{id}/update', [PetugasController::class, 'update'])->name('petugas.update');
        Route::delete('/petugas/{id}', [PetugasController::class, 'destroy'])->name('petugas.destroy');

    });
});

require __DIR__.'/auth.php';
