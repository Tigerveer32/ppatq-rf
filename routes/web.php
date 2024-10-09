<?php

use App\Http\Controllers\ChangePasswordController;
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
Route::group(['middleware' => 'auth'], function () {
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


    Route::get('/', [HomeController::class, 'home']);
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Rute lainnya ...
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
