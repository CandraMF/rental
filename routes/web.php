<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\Member\MemberPenyewaanController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

    Route::middleware(['role:admin', 'verified'])->prefix('/admin')->name('admin.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/kendaraan', [KendaraanController::class, 'index'])->name('kendaraan.index');
        Route::get('/kendaraan/create', [KendaraanController::class, 'create'])->name('kendaraan.create');
        Route::post('/kendaraan/store', [KendaraanController::class, 'store'])->name('kendaraan.store');
        Route::get('/kendaraan/{id}', [KendaraanController::class, 'show'])->name('kendaraan.show');
        Route::get('/kendaraan/{id}/edit', [KendaraanController::class, 'edit'])->name('kendaraan.edit');
        Route::post('/kendaraan/{id}/update', [KendaraanController::class, 'update'])->name('kendaraan.update');
        Route::delete('/kendaraan/{id}', [KendaraanController::class, 'destroy'])->name('kendaraan.destroy');

        Route::get('/petugas', [PetugasController::class, 'index'])->name('petugas.index');
        Route::get('/petugas/create', [PetugasController::class, 'create'])->name('petugas.create');
        Route::post('/petugas/store', [PetugasController::class, 'store'])->name('petugas.store');
        Route::get('/petugas/{id}', [PetugasController::class, 'show'])->name('petugas.show');
        Route::get('/petugas/{id}/edit', [PetugasController::class, 'edit'])->name('petugas.edit');
        Route::post('/petugas/{id}/update', [PetugasController::class, 'update'])->name('petugas.update');
        Route::delete('/petugas/{id}', [PetugasController::class, 'destroy'])->name('petugas.destroy');

        Route::get('/member', [MemberController::class, 'index'])->name('member.index');
        Route::get('/member/create', [MemberController::class, 'create'])->name('member.create');
        Route::post('/member/store', [MemberController::class, 'store'])->name('member.store');
        Route::get('/member/{id}', [MemberController::class, 'show'])->name('member.show');
        Route::get('/member/{id}/edit', [MemberController::class, 'edit'])->name('member.edit');
        Route::post('/member/{id}/update', [MemberController::class, 'update'])->name('member.update');
        Route::delete('/member/{id}', [MemberController::class, 'destroy'])->name('member.destroy');

        Route::get('/penyewaan', [PenyewaanController::class, 'index'])->name('penyewaan.index');
        Route::get('/penyewaan/create', [PenyewaanController::class, 'create'])->name('penyewaan.create');
        Route::post('/penyewaan/store', [PenyewaanController::class, 'store'])->name('penyewaan.store');
        Route::get('/penyewaan/{id}', [PenyewaanController::class, 'show'])->name('penyewaan.show');
        Route::get('/penyewaan/{id}/edit', [PenyewaanController::class, 'edit'])->name('penyewaan.edit');
        Route::post('/penyewaan/{id}/update', [PenyewaanController::class, 'update'])->name('penyewaan.update');
        Route::delete('/penyewaan/{id}', [PenyewaanController::class, 'destroy'])->name('penyewaan.destroy');

        Route::post('/penyewaan/terima', [PenyewaanController::class, 'terima'])->name('penyewaan.terima');
        Route::post('/penyewaan/tolak', [PenyewaanController::class, 'tolak'])->name('penyewaan.tolak');

        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
        Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
        Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    });

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
    });
});

require __DIR__.'/auth.php';
