<?php

use App\Http\Controllers\SessionController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\LaporSampahController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Mail\Registrasi;

/*
|--------------------------------------------------------------------------
| Rute Web
|--------------------------------------------------------------------------
|
| Di sinilah Anda dapat mendaftarkan rute web untuk aplikasi Anda.
| Rute ini dimuat oleh RouteServiceProvider dan semuanya akan
| ditetapkan ke grup middleware "web". Buat sesuatu yang hebat!
|
*/

Route::get('/', function () {
    return view('halaman.hero-blocks');
})->middleware('isTamu');

Route::get('/home', function () {
    return view('halaman.home');
});


Route::get('/riwayat-lapor', [LaporSampahController::class, 'riwayat'])->name('riwayat-lapor');
Route::get('/riwayat-lapor/edit/{id}', [LaporSampahController::class, 'edit'])->name('riwayat-lapor.edit');
Route::post('/riwayat-lapor/update/{id}', [LaporSampahController::class, 'update'])->name('riwayat-lapor.update');
Route::delete('/riwayat-lapor/delete/{id}', [LaporSampahController::class, 'destroy'])->name('riwayat-lapor.delete');

Route::get('/dashboard/warga', function () {
    return view('dashboard.warga');
})->middleware('IsLogin');

Route::post('/dashboard/warga', function () {
    return view('dashboard.warga')->middleware('sesi');
});

Route::get('/halaman/setting', function () {
    return view('halaman.setting');
});

// Rute untuk halaman laporan sampah
Route::get('/lapor-sampah', [LaporSampahController::class, 'create'])->name('lapor-sampah.create');
Route::post('/lapor-sampah', [LaporSampahController::class, 'store'])->name('lapor-sampah.store');

// Rute untuk halaman payment
Route::get('/halaman/payment', function () {
    return view('halaman.payment');
})->middleware('IsLogin');

Route::get('/layouts/main', function () {
    return view('layouts.main');
});

// Rute Autentikasi
Route::middleware('isTamu')->group(function () {
    Route::get('/sesi', [SessionController::class, 'index'])->name('login');
    Route::post('/sesi/login', [SessionController::class, 'login'])->name('sesi.login');
    Route::get('/register', [SessionController::class, 'register'])->name('sesi.register');
    Route::post('/register', [SessionController::class, 'storeRegister'])->name('register.store');
});

Route::middleware('IsLogin')->group(function () {
    Route::get('/sesi/logout', [SessionController::class, 'logout'])->name('sesi.logout');
});

Route::get('/sesi/change-password', [SessionController::class, 'changePassword'])->name('sesi.change-password');
Route::post('/sesi/change-password', [SessionController::class, 'storeChangePassword'])->name('sesi.store-change-password');
// Rute Reset Password
Route::get('/sesi/forget-password', [SessionController::class, 'forgetPassword'])->name('sesi.forget-password');
Route::post('/password/email', [SessionController::class, 'storeForgetPassword'])->name('sesi.store-forget-password');
Route::get('/forget-password-success', [SessionController::class, 'forgetPasswordSuccess'])->name('sesi.forget-password-success');
Route::get('/forget-password-failed', [SessionController::class, 'forgetPasswordFailed'])->name('sesi.forget-password-failed');
Route::get('/verify/{key}', [SessionController::class, 'verify'])->name('verify');

// Form dan Proses Reset Password
Route::get('password/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [PasswordResetController::class, 'reset'])->name('password.update');
Route::post('/verify-code', [PasswordResetController::class, 'verifyCode'])->name('verify.code');

// // Rute Lapor Sampah
// Route::get('/lapor-sampah', [LaporSampahController::class, 'create'])->middleware('isLogin');
// Route::post('/lapor-sampah', [LaporSampahController::class, 'store'])->name('lapor-sampah.store');
