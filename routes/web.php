<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardTahfidzController;
use App\Http\Controllers\HafalanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\TahfidzController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SantriTahfidzController;
use App\Http\Controllers\UserController;

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

// Rute untuk pengguna yang sudah terautentikasi
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    // route santri
    Route::get('/santri', [SantriController::class, 'index'])->name('admin.santri.index');
    Route::get('/santri/form', [SantriController::class, 'form'])->name('admin.santri.form');
    Route::post('/santri/store', [SantriController::class, 'store'])->name('admin.santri.store');
	Route::get('/santri/{santri}', [SantriController::class, 'edit'])->name('admin.santri.edit');
    Route::put('/santri/{santri}', [SantriController::class, 'update'])->name('admin.santri.update');
    Route::delete('/santri/{santri}', [SantriController::class, 'destroy'])->name('admin.santri.destroy');
    //route pegawai
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('admin.pegawai.index');
    Route::get('/pegawai/form', [PegawaiController::class, 'form'])->name('admin.pegawai.form');
    Route::post('/pegawai/store', [PegawaiController::class, 'store'])->name('admin.pegawai.store');
	Route::get('/pegawai/{pegawai}', [PegawaiController::class, 'edit'])->name('admin.pegawai.edit');
    Route::put('/pegawai/{pegawai}', [PegawaiController::class, 'update'])->name('admin.pegawai.update');
    Route::delete('/pegawai/{pegawai}', [PegawaiController::class, 'destroy'])->name('admin.pegawai.destroy');
    //route tahfidz
    Route::get('/tahfidz', [TahfidzController::class, 'index'])->name('admin.tahfidz.index');
    Route::get('/tahfidz/form', [TahfidzController::class, 'form'])->name('admin.tahfidz.form');
    Route::post('/tahfidz/store', [TahfidzController::class, 'store'])->name('admin.tahfidz.store');
	Route::get('/tahfidz/{tahfidz}', [TahfidzController::class, 'edit'])->name('admin.tahfidz.edit');
    Route::put('/tahfidz/{tahfidz}', [TahfidzController::class, 'update'])->name('admin.tahfidz.update');
    Route::delete('/tahfidz/{tahfidz}', [TahfidzController::class, 'destroy'])->name('admin.tahfidz.destroy');
    // Route untuk Santri Tahfidz
    Route::get('/santri_tahfidz/{id_tahfidz}', [SantriTahfidzController::class, 'index'])->name('admin.santri_tahfidz.index');
    Route::get('/santri_tahfidz/{id_tahfidz}/form', [SantriTahfidzController::class, 'form'])->name('admin.santri_tahfidz.form');
    Route::post('/santri_tahfidz/{id_tahfidz}/store', [SantriTahfidzController::class, 'store'])->name('admin.santri_tahfidz.store');
    Route::delete('/santri_tahfidz/{id_tahfidz}/{santri_tahfidz}', [SantriTahfidzController::class, 'destroy'])->name('admin.santri_tahfidz.destroy');
    //route untuk hafalan
    Route::get('/hafalan', [HafalanController::class, 'index'])->name('admin.hafalan.index');
    Route::get('/hafalan/hafalan/{id_tahfidz}', [HafalanController::class, 'hafalan'])->name('admin.hafalan.hafalan');
    Route::get('/hafalan/{id_tahfidz}/form', [HafalanController::class, 'form'])->name('admin.hafalan.form');
    Route::post('/hafalan/{id_tahfidz}/store', [HafalanController::class, 'store'])->name('admin.hafalan.store');
    Route::get('/hafalan/{tahfidz}', [HafalanController::class, 'edit'])->name('admin.hafalan.edit');
    Route::put('/hafalan/{tahfidz}', [HafalanController::class, 'update'])->name('admin.hafalan.update');
    Route::delete('/hafalan/{tahfidz}', [HafalanController::class, 'destroy'])->name('admin.hafalan.destroy');
    //route user management
    // Route untuk mengelola pengguna
    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/form/{user?}', [UserController::class, 'form'])->name('admin.users.form');
    Route::post('/users/store', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy'); 

    Route::get('/', [HomeController::class, 'home']);
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', [SessionsController::class, 'destroy'])->name('logout');

    // Rute lainnya ...
});

    //Route tahfidz
    Route::group(['middleware' => ['auth', 'role:tahfidz']], function () {
        Route::get('/', [DashboardTahfidzController::class, 'index'])-> name('tahfidz.dashboard');
        Route::get('/tahfidz', [TahfidzController::class, 'index'])->name('admin.tahfidz.index');
        Route::get('/tahfidz/form', [TahfidzController::class, 'form'])->name('admin.tahfidz.form');
        Route::post('/tahfidz/store', [TahfidzController::class, 'store'])->name('admin.tahfidz.store');
        Route::get('/tahfidz/{tahfidz}', [TahfidzController::class, 'edit'])->name('admin.tahfidz.edit');
        Route::put('/tahfidz/{tahfidz}', [TahfidzController::class, 'update'])->name('admin.tahfidz.update');
        Route::delete('/tahfidz/{tahfidz}', [TahfidzController::class, 'destroy'])->name('admin.tahfidz.destroy');
    });


// Rute untuk pengguna tamu
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
});

// Rute untuk tampilan login
Route::get('/login', function () {
    return view('session/login-session');
})->name('login');
