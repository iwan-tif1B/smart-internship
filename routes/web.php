<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DatalistController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MasterpsController;
use App\Http\Controllers\PeminjamanController;

Route::get('/', function () {
    return view('pages.auth.auth-login');
});
Route::get('/register', function () {
    return view('pages.auth.register');
});

Route::middleware(['auth'])->group(function () {
    Route::get('home', function () {
        return view('pages.dashboard', ['type_menu' => 'home']);
    })->name('home');

    Route::resource('users', UserController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('buku', BukuController::class);
    // Route::put('masterps/{masterps}', [MasterpsController::class, 'update'])->name('masterps.update');
    Route::resource('masterps', MasterpsController::class);

    // details masters
    Route::get('masterps/{id}/detail_masters', [MasterpsController::class, 'detail_masters'])->name('masterps.detail_masters');
    Route::get('masterps/{id}/create_rent_session', [MasterpsController::class, 'create_rent_session'])->name('masterps.create_rent_session');
    Route::post('masterps/store_rent_session', [MasterpsController::class, 'store_rent_session'])->name('masterps.store_rent_session');
    Route::get('masterps/{id}/edit_rent_session', [MasterpsController::class, 'edit_rent_session'])->name('masterps.edit_rent_session');

    // detail session
    Route::get('masterps/{id}/detail_session', [MasterpsController::class, 'detail_session'])->name('masterps.detail_session');
    Route::get('masterps/{id}/create_details_session', [MasterpsController::class, 'create_details_session'])->name('masterps.create_details_session');
    Route::get('masterps/{id}/edit_details_session', [MasterpsController::class, 'edit_details_session'])->name('masterps.edit_details_session');
    Route::post('masterps/store_details_session', [MasterpsController::class, 'store_details_session'])->name('masterps.store_details_session');

    // list ps
    Route::resource('datalist', DatalistController::class);
    Route::post('datalist/search_playstation', [DatalistController::class, 'search_playstation'])->name('datalist.search_playstation');
    Route::post('datalist/store_payment', [DatalistController::class, 'store_payment'])->name('datalist.store_payment');
    Route::get('datalist/detail_booked', [DatalistController::class, 'detail_booked'])->name('datalist.detail_booked');

    // post to midtrans
    Route::post('/create-transaction', [PaymentController::class, 'createTransaction']);


    Route::resource('pinjam', PeminjamanController::class);
});
