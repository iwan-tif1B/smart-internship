<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministrasiController;
use App\Http\Controllers\KemampuanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DatalistController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MasterpsController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\WawancaraController;
use App\Http\Controllers\PosisiController;
use App\Http\Controllers\KriteriaPenilaianController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelolaMentorController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TemplateSertifikatController;
use App\Http\Controllers\SertifikatPenilaianController;
use App\Http\Controllers\BerhasilDaftarController;
use App\Http\Controllers\KegiatankuController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\PosisiUserController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PesertaMagangAktifController;
use App\Http\Controllers\PendaftarMagangController;
use App\Http\Controllers\AlumniMagangController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DetailProjekController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\PenilaianMentorController;
use App\Http\Controllers\BeriSertifikatController;
use App\Http\Controllers\ProfileAdminController;
use App\Http\Controllers\ProfileMentorController;
use App\Http\Controllers\ProfileHrdController;



Route::get('/user', function () {
    return view('pages.user.berhasidaftar.index');
})->name('user.home');

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
    Route::resource('profile', UserController::class);
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
    Route::resource('kelolamentor', KelolaMentorController::class);
    Route::resource('kriteriapenilaian', KriteriaPenilaianController::class);
    Route::resource('testimoni', TestimoniController::class);
    Route::resource('templatesertifikat', TemplateSertifikatController::class);
    Route::resource('sertifikatpenilaian', SertifikatPenilaianController::class);
    Route::resource('berhasildaftar', BerhasilDaftarController::class);
    Route::resource('kegiatanku', KegiatankuController::class);
    Route::resource('notifikasi', NotifikasiController::class);
    Route::resource('posisiuser', PosisiUserController::class);
    Route::resource('detailprojek', DetailProjekController::class);
    Route::resource('penilaian', PenilaianController::class);
    Route::resource('pesertamagangaktif', PesertaMagangAktifController::class);
    Route::resource('pendaftarmagang', PendaftarMagangController::class);
    Route::resource('alumnimagang', AlumniMagangController::class);
    Route::resource('monitoring', ProjectController::class);
    Route::resource('detailmonitoring', DetailProjekController::class);
    Route::resource('dataalumni', AlumniController::class);
    Route::resource('penilaianmentor', PenilaianMentorController::class);
    Route::resource('berisertifikat', BeriSertifikatController::class);
    Route::resource('profileadmin', ProfileAdminController::class);
    Route::resource('profilementor', ProfileMentorController::class);
    Route::resource('profilehrd', ProfileHrdController::class);


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
    Route::post('/administrasi/terima', [AdministrasiController::class, 'terima'])->name('administrasi.terima');
    Route::post('/administrasi/tolak', [AdministrasiController::class, 'tolak'])->name('administrasi.tolak');

    // Kemampuan Specific Routes (Soal)
    Route::prefix('kemampuan')->group(function () {
        Route::get('{id}/soal', [KemampuanController::class, 'showSoal'])->name('kemampuan.showSoal');
        Route::get('create', [KemampuanController::class, 'create'])->name('kemampuan.create');
        Route::post('', [KemampuanController::class, 'store'])->name('kemampuan.store');
        Route::post('terima', [KemampuanController::class, 'terima'])->name('kemampuan.terima');
        Route::post('tolak', [KemampuanController::class, 'tolak'])->name('kemampuan.tolak');
    });

    // Wawancara Specific Routes
    Route::post('lulus', [WawancaraController::class, 'lulus'])->name('wawancara.lulus');
    Route::post('tolak', [WawancaraController::class, 'tolak'])->name('wawancara.tolak');

    Route::get('/pesertamagangaktif/export-pdf', [PesertaMagangAktifController::class, 'exportPdf'])->name('pesertamagangaktif.export.pdf');
    Route::get('/pendaftarmagang/export-pdf', [PendaftarMagangController::class, 'exportPdf'])->name('pendaftarmagang.export.pdf');
    Route::get('/alumnimagang/export-pdf', [AlumniMagangController::class, 'exportPdf'])->name('alumnimagang.export.pdf');
    Route::get('/alumni/export-pdf', [AlumniController::class, 'exportPdf'])->name('alumni.export.pdf');


    // Route::get('/detailmonitoring/{id}', [ProjectController::class, 'show'])->name('detailmonitoring.show');
});
