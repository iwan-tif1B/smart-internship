<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministrasiController;
use App\Http\Controllers\KemampuanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DatalistController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MasterpsController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\WawancaraController;
use App\Http\Controllers\PosisiController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\TemplatePenilaianController;
use App\Http\Controllers\KelolaMentorController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\RegisterController;




Route::post('/create_new_account/store', [RegisterController::class, 'store'])->name('create_new_account.store');
// Authentication Routes
Route::get('/', function () {
    return view('pages.auth.home');
});
Route::get('/signin', function () {
    return view('pages.auth.auth-login');
});
Route::get('/register', function () {
    return view('pages.auth.register');
});

// Protected Routes (Requires Authentication)
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('home', function () {
        return view('pages.dashboard', ['type_menu' => 'home']);
    })->name('home');

    // Resources (Standard CRUD)
    Route::resource('users', UserController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('administrasi', AdministrasiController::class);
    Route::resource('kemampuan', KemampuanController::class);
    Route::resource('wawancara', WawancaraController::class);
    Route::resource('posisi', PosisiController::class);
    Route::resource('jurusan', JurusanController::class);
    Route::resource('instansi', InstansiController::class);
    Route::resource('masterps', MasterpsController::class);
    Route::resource('datalist', DatalistController::class);
    Route::resource('pinjam', PeminjamanController::class);
    Route::resource('sertifikat', SertifikatController::class);
    Route::resource('templatepenilaian', TemplatePenilaianController::class);
    Route::resource('kelolamentor', KelolaMentorController::class);
    Route::resource('kriteria', KriteriaController::class);
    Route::resource('testimoni', TestimoniController::class);
    Route::resource('penilaian', PenilaianController::class);

    // Mitra Blacklist/Unblacklist Routes (Didefinisikan di luar resource untuk kejelasan)
    Route::put('instansi/{instansi}/blacklist', [InstansiController::class, 'blacklist'])->name('instansi.blacklist');
    Route::put('instansi/{instansi}/unblacklist', [InstansiController::class, 'unblacklist'])->name('instansi.unblacklist');

    // Master PS Specific Routes
    Route::prefix('masterps/{id}')->group(function () {
        Route::get('detail_masters', [MasterpsController::class, 'detail_masters'])->name('masterps.detail_masters');
        Route::get('create_rent_session', [MasterpsController::class, 'create_rent_session'])->name('masterps.create_rent_session');
        Route::get('edit_rent_session', [MasterpsController::class, 'edit_rent_session'])->name('masterps.edit_rent_session');
        Route::get('detail_session', [MasterpsController::class, 'detail_session'])->name('masterps.detail_session');
        Route::get('create_details_session', [MasterpsController::class, 'create_details_session'])->name('masterps.create_details_session');
        Route::get('edit_details_session', [MasterpsController::class, 'edit_details_session'])->name('masterps.edit_details_session');
    });
    Route::post('masterps/store_rent_session', [MasterpsController::class, 'store_rent_session'])->name('masterps.store_rent_session');
    Route::post('masterps/store_details_session', [MasterpsController::class, 'store_details_session'])->name('masterps.store_details_session');

    // Datalist Specific Routes
    Route::post('datalist/search_playstation', [DatalistController::class, 'search_playstation'])->name('datalist.search_playstation');
    Route::post('datalist/store_payment', [DatalistController::class, 'store_payment'])->name('datalist.store_payment');
    Route::get('datalist/detail_booked', [DatalistController::class, 'detail_booked'])->name('datalist.detail_booked');

    // Payment Routes
    Route::post('/create-transaction', [PaymentController::class, 'createTransaction']);

    // Administrasi Specific Routes
    Route::put('/administrasi/terima', [AdministrasiController::class, 'terima'])->name('administrasi.terima');
    Route::put('/administrasi/tolak', [AdministrasiController::class, 'tolak'])->name('administrasi.tolak');

    // Kemampuan Specific Routes (Soal)
    Route::prefix('kemampuan')->group(function () {
        Route::get('{id}/soal', [KemampuanController::class, 'showSoal'])->name('kemampuan.showSoal');
        Route::get('create', [KemampuanController::class, 'create'])->name('kemampuan.create');
        Route::post('', [KemampuanController::class, 'store'])->name('kemampuan.store');
        Route::put('terima', [KemampuanController::class, 'terima'])->name('kemampuan.terima');
        Route::put('tolak', [KemampuanController::class, 'tolak'])->name('kemampuan.tolak');
    });

    // Wawancara Specific Routes
    Route::put('lulus', [WawancaraController::class, 'lulus'])->name('wawancara.lulus');
    Route::put('tolak', [WawancaraController::class, 'tolak'])->name('wawancara.tolak');
});
