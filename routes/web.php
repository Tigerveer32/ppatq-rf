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
use App\Http\Controllers\MurobbyController;
use App\Http\Controllers\SantriMurobbyController;
use App\Http\Controllers\Tahfidz\KetahfidzanController;
use App\Http\Controllers\Tahfidz\TargetHafalanController;
use App\Http\Controllers\Santri\PembayaranSantriController;


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
    Route::get('/kelompok_tahfidz', [SantriTahfidzController::class, 'indexTahfidz'])->name('admin.santri_tahfidz.indexTahfidz');
    Route::get('/kelompok_tahfidz/{id_tahfidz}/santri', [SantriTahfidzController::class, 'indexSantri'])->name('admin.santri_tahfidz.indexSantri');
    Route::get('/kelompok_tahfidz/{id_tahfidz}/santri/create', [SantriTahfidzController::class, 'form'])->name('admin.santri_tahfidz.form');
    Route::post('/kelompok_tahfidz/{id_tahfidz}/santri', [SantriTahfidzController::class, 'store'])->name('admin.santri_tahfidz.store');
    Route::get('/kelompok_tahfidz/{id_tahfidz}/santri/{id_santri_tahfidz}/edit', [SantriTahfidzController::class, 'edit'])->name('admin.santri_tahfidz.edit');
    Route::put('/kelompok_tahfidz/{id_tahfidz}/santri/{id}', [SantriTahfidzController::class, 'update'])->name('update');
    Route::delete('/kelompok_tahfidz/{id_tahfidz}/santri/{id_santri}', [SantriTahfidzController::class, 'destroy'])->name('admin.santri_tahfidz.destroy');
    //route untuk hafalan
    Route::get('/hafalan', [HafalanController::class, 'index'])->name('admin.hafalan.index');
    Route::get('/hafalan/hafalan/{id_tahfidz}', [HafalanController::class, 'hafalan'])->name('admin.hafalan.hafalan');
    Route::get('/hafalan/{id_tahfidz}/form', [HafalanController::class, 'form'])->name('admin.hafalan.form');
    Route::post('/hafalan/{id_tahfidz}/store', [HafalanController::class, 'store'])->name('admin.hafalan.store');
    Route::get('/hafalan/{tahfidz}', [HafalanController::class, 'edit'])->name('admin.hafalan.edit');
    Route::put('/hafalan/{tahfidz}', [HafalanController::class, 'update'])->name('admin.hafalan.update');
    Route::delete('/hafalan/{tahfidz}', [HafalanController::class, 'destroy'])->name('admin.hafalan.destroy');
    //route untuk murobby
    Route::get('/murobby', [MurobbyController::class, 'index'])->name('admin.murobby.index');
    Route::get('/murobby/create', [MurobbyController::class, 'create'])->name('admin.murobby.form');
    Route::post('/murobby', [MurobbyController::class, 'store'])->name('admin.murobby.store');
    Route::get('/murobby/{id_murobby}/edit', [MurobbyController::class, 'edit'])->name('admin.murobby.edit');
    Route::put('/murobby/{id_murobby}', [MurobbyController::class, 'update'])->name('admin.murobby.update');
    Route::delete('/murobby/{id_murobby}', [MurobbyController::class, 'destroy'])->name('admin.murobby.destroy');
    //route untuk santri murobby
    Route::get('/kelompok_murobby', [SantriMurobbyController::class, 'index'])->name('admin.santri_murobby.index');
    Route::get('/kelompok_murobby/{id_murobby}/santri', [SantriMurobbyController::class, 'indexSantri'])->name('admin.santri_murobby.indexSantri');
    Route::get('/kelompok_murobby/{id_murobby}/santri/create', [SantriMurobbyController::class, 'create'])->name('admin.santri_murobby.create');
    Route::post('/kelompok_murobby/{id_murobby}/santri', [SantriMurobbyController::class, 'store'])->name('admin.santri_murobby.store');
    Route::get('/kelompok_murobby/{id_murobby}/santri/{id_santri}/edit', [SantriMurobbyController::class, 'edit'])->name('admin.santri_murobby.edit');
    Route::put('/kelompok_murobby/{id_murobby}/santri/{id_santri}', [SantriMurobbyController::class, 'update'])->name('admin.santri_murobby.update');
    Route::delete('/kelompok_murobby/{id_murobby}/santri/{id_santri}', [SantriMurobbyController::class, 'destroy'])->name('admin.santri_murobby.destroy');
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

    // Rute lainnya ...
});

    //Route tahfidz
    Route::group(['middleware' => ['auth', 'role:tahfidz']], function () {
        // Dashboard Tahfidz
        Route::get('/dashboard-tahfidz', [DashboardTahfidzController::class, 'index'])->name('tahfidz.dashboard');
    
        // Ketahfidzan Routes
        Route::get('/ketahfidzan', [KetahfidzanController::class, 'index'])->name('tahfidz.tahfidz.index'); // Daftar ketahfidzan
        Route::get('/ketahfidzan/hafalan', [KetahfidzanController::class, 'hafalan'])->name('tahfidz.tahfidz.hafalan'); // Daftar hafalan
        Route::get('/ketahfidzan/hafalan/form', [KetahfidzanController::class, 'form'])->name('tahfidz.tahfidz.form'); // Form input hafalan
        Route::post('/ketahfidzan/hafalan', [KetahfidzanController::class, 'store'])->name('tahfidz.tahfidz.store'); // Simpan hafalan
        Route::get('/ketahfidzan/hafalan/{tahfidz}/edit', [KetahfidzanController::class, 'edit'])->name('tahfidz.tahfidz.edit');
        Route::put('/ketahfidzan/hafalan/{tahfidz}', [KetahfidzanController::class, 'update'])->name('tahfidz.tahfidz.update');
        Route::delete('/ketahfidzan/hafalan/{tahfidz}', [KetahfidzanController::class, 'destroy'])->name('tahfidz.tahfidz.destroy');

        Route::get('/target-hafalan', [TargetHafalanController::class, 'index'])->name('tahfidz.target.index');

        Route::get('/target-hafalan/form', [TargetHafalanController::class, 'form'])->name('tahfidz.target.form'); 
        Route::post('/target-hafalan/hafalan', [TargetHafalanController::class, 'store'])->name('tahfidz.target.store'); 
        Route::delete('tahfidz/target/{targetHafalan}', [TargetHafalanController::class, 'destroy'])->name('tahfidz.target.destroy');

        //route chart
        Route::get('/chart', [TargetHafalanController::class, 'chart'])->name('tahfidz.grafik.chart');
    });


    //Route Santri
    Route::group(['middleware' => ['auth', 'role:walsan']], function () {
        Route::get('/walsan', function () {
            return view('santri.dashboard'); // Ganti dengan view yang sesuai
        })->name('santri.dashboard');

        //route pembayran
        Route::get('/walsan/pembayaran', [PembayaranSantriController::class, 'index'])->name('santri.pembayaran.index');
        Route::get('/walsan/pembayaran/create', [PembayaranSantriController::class, 'create'])->name('santri.pembayaran.create');
        Route::post('/walsan/pembayaran/store', [PembayaranSantriController::class, 'store'])->name('santri.pembayaran.store');
        Route::get('/walsan/pembayaran/{id_pembayaran}', [PembayaranSantriController::class, 'show'])->name('santri.pembayaran.show');
        Route::post('walsan/pembayaran/snap_token', [PembayaranSantriController::class, 'createMidtransToken'])->name('santri.pembayaran.snap_token');
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

// Rute untuk pengguna yang sudah terautentikasi, termasuk untuk logout
Route::group(['middleware' => ['auth']], function () {
    Route::post('/logout', [SessionsController::class, 'destroy'])->name('logout');
});


