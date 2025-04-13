<?php

use App\Http\Controllers\SessionController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\LaporSampahController;
use App\Http\Controllers\TimOperasionalController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminReportController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\AdminInsentifController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminValidasiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sinilah Anda dapat mendaftarkan rute web untuk aplikasi Anda.
| Rute ini dimuat oleh RouteServiceProvider dan semuanya akan
| ditetapkan ke grup middleware "web". Buat sesuatu yang hebat!
|
*/

// Halaman Utama
Route::get('/', function () {
    return view('halaman.hero-blocks');
})->middleware('isTamu');

Route::get('/home', function () {
    return view('halaman.home');
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
    Route::post('/sesi/logout', [SessionController::class, 'logout'])->name('sesi.logout');
    Route::get('/sesi/change-password', [SessionController::class, 'changePassword'])->name('sesi.change-password');
    Route::post('/sesi/change-password', [SessionController::class, 'storeChangePassword'])->name('sesi.store-change-password');
});

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

// Rute Warga
Route::middleware(['auth', 'IsLogin'])->group(function () {
    Route::get('/dashboard/warga', [WargaController::class, 'index'])->name('warga.dashboard');
    Route::get('/edit-profil', [WargaController::class, 'editProfil'])->name('warga.edit-profil');
    Route::put('/update-profil', [WargaController::class, 'updateProfil'])->name('warga.update-profil');
});

// Rute Tim Operasional
Route::middleware(['auth', 'role:tim_operasional'])->group(function () {
    Route::get('/dashboard/tim-operasional', [TimOperasionalController::class, 'index'])->name('tim-operasional.dashboard');
    Route::get('/tim-operasional/laporan/menunggu', [TimOperasionalController::class, 'laporanMenunggu'])->name('tim-operasional.laporan.menunggu');
    Route::get('/tim-operasional/laporan/diangkut', [TimOperasionalController::class, 'laporanDiangkut'])->name('tim-operasional.laporan.diangkut');
    Route::get('/tim-operasional/profil', [TimOperasionalController::class, 'profil'])->name('tim-operasional.profil');
    Route::patch('/riwayat-lapor/{id}/ubah-status/{status}', [LaporSampahController::class, 'ubahStatus'])->name('riwayat-lapor.ubah-status');
});

// Rute Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/reports', [AdminReportController::class, 'index'])->name('admin.reports.index');
    Route::get('/admin/settings', [AdminSettingController::class, 'index'])->name('admin.settings.index');
    Route::get('/riwayat-lapor/{id}/edit', [LaporSampahController::class, 'edit'])->name('riwayat-lapor.edit');
    Route::patch('/riwayat-lapor/{id}/validasi', [LaporSampahController::class, 'validasi'])->name('riwayat-lapor.validasi');
    Route::delete('/admin/users/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('/admin/users/{id}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');
    Route::get('/admin/validasi', [AdminValidasiController::class, 'index'])->name('admin.validasi.index');
    Route::post('/admin/validasi/{id}', [AdminValidasiController::class, 'validasi'])->name('admin.validasi');
    Route::get('/admin/validasi/cetak-pdf', [AdminValidasiController::class, 'cetakPdf'])->name('admin.validasi.cetak-pdf');

    // Rute Insentif
    Route::prefix('admin/insentif')->group(function () {
        Route::get('/add-poin', [AdminInsentifController::class, 'create'])->name('admin.insentif.add-poin');
        Route::post('/add-poin', [AdminInsentifController::class, 'store'])->name('admin.insentif.add-poin');
    });
});

// Rute Laporan Sampah
Route::middleware(['auth'])->group(function () {
    Route::get('/riwayat-lapor', [LaporSampahController::class, 'riwayat'])->name('riwayat-lapor');
    Route::get('/riwayat-lapor/{id}/pembayaran', [LaporSampahController::class, 'pembayaran'])->name('riwayat-lapor.pembayaran');
    Route::post('/riwayat-lapor/{id}/bayar', [LaporSampahController::class, 'bayar'])->name('riwayat-lapor.bayar');
    Route::patch('/riwayat-lapor/ubah-status/{id}', [LaporSampahController::class, 'ubahStatus'])->name('riwayat-lapor.ubah-status');
});

Route::get('/lapor-sampah', [LaporSampahController::class, 'create'])->name('lapor-sampah.create');
Route::post('/lapor-sampah', [LaporSampahController::class, 'store'])->name('lapor-sampah.store');
Route::post('/midtrans/notification', [LaporSampahController::class, 'handleNotification'])->name('midtrans.notification');

// Rute Halaman Lain
Route::get('/halaman/setting', function () {
    return view('halaman.setting');
});
Route::get('/halaman/payment', function () {
    return view('halaman.payment');
})->middleware('IsLogin');
Route::get('/layouts/main', function () {
    return view('layouts.main');
});

// Rute Pembayaran
Route::get('/pembayaran/{id}', [PaymentController::class, 'createTransaction'])->name('pembayaran.create');

//Rute Coming Soon
Route::get('/coming-soon', function () {
    return view('halaman.coming-soon');
})->name('halaman.coming-soon');
