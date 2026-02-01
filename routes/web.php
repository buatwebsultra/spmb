<?php

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

Route::get('/', [App\Http\Controllers\LandingController::class, 'landing']);

Auth::routes(['verify' => true]);
Route::get('/qr/{no}', [App\Http\Controllers\HomeController::class, 'qrcodeUrl']);
Route::get('/images/{filename}', [App\Http\Controllers\ImageController::class, 'image']);
Route::get('/bghead', [App\Http\Controllers\ImageController::class, 'bghead']);
Route::get('/logo', [App\Http\Controllers\ImageController::class, 'logo']);
Route::get('/pdf-pengumuman/{id}', [App\Http\Controllers\PrintController::class, 'getPdfPengumuman']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/home', App\Http\Livewire\Dashboard::class)->name('home');
    Route::group(['prefix'=>'pendaftaran'], function(){
        Route::get('/', App\Http\Livewire\Pendaftaran::class)->name('pendaftaran')->middleware(['auth', 'is-level']);
        Route::get('/form', App\Http\Livewire\PendaftaranInput::class)->name('pendaftaran.form');
        Route::get('/show', App\Http\Livewire\PendaftaranShow::class)->name('pendaftaran.show');
        Route::get('/upload', App\Http\Livewire\PendaftaranUpload::class)->name('pendaftaran.upload');

    });

    Route::get('/bglunas', [App\Http\Controllers\ImageController::class, 'bglunas']);
    Route::get('/bgunpaid', [App\Http\Controllers\ImageController::class, 'bgunpaid']);

    Route::middleware(['is-level'])->group(function () {
        Route::group(['prefix'=>'pembayaran'], function(){
            Route::get('/', App\Http\Livewire\Pembayaran::class)->name('pembayaran');
            Route::get('/pendaftaran', App\Http\Livewire\BayarPendaftaran::class)->name('pembayaran.pendaftaran');
            Route::get('/spp', App\Http\Livewire\BayarSpp::class)->name('pembayaran.spp');
        });
        
        Route::group(['prefix'=>'seleksi'], function(){
            Route::get('/', App\Http\Livewire\Seleksi::class)->name('seleksi');
            Route::get('/jadwal', App\Http\Livewire\SeleksiJadwal::class)->name('seleksi.jadwal');
            Route::get('/hasil', App\Http\Livewire\SeleksiHasil::class)->name('seleksi.hasil');
        });

        Route::group(['prefix'=>'daftarulang'], function(){
            Route::get('/', App\Http\Livewire\DaftarUlang::class)->name('daftarulang');
            
        });
        Route::group(['prefix'=>'setting'], function(){
            Route::get('/', App\Http\Livewire\Setting::class)->name('setting');
            Route::get('/aplikasi', App\Http\Livewire\Setting::class)->name('setting.aplikasi');
            Route::get('/pengguna', App\Http\Livewire\Pengguna::class)->name('setting.pengguna');
        });
        
    });
    Route::get('/daftarulang/form', App\Http\Livewire\DaftarUlangForm::class)->name('daftarulang.form');
    Route::group(['prefix'=>'cetak'], function(){
        Route::get('/form/{idp}', [App\Http\Controllers\PrintController::class, 'printPendaftaran']);
        Route::get('/invoice-daftar/{idp}', [App\Http\Controllers\PrintController::class, 'printInvoiceDaftar']);
        Route::get('/kartu-ujian/{idp}', [App\Http\Controllers\PrintController::class, 'printKartuUjian']);
        Route::get('/invoice-spp/{idp}', [App\Http\Controllers\PrintController::class, 'printInvoiceSpp']);
        Route::get('/jadwal', [App\Http\Controllers\PrintController::class, 'printJadwal']);
        Route::get('/hasil', [App\Http\Controllers\PrintController::class, 'printHasil']);
    });
});
Route::get('/photo/{filename}', [App\Http\Controllers\ImageController::class, 'photo']);
Route::get('/ijazah/{filename}', [App\Http\Controllers\ImageController::class, 'ijazah']);
Route::get('/transkip/{filename}', [App\Http\Controllers\ImageController::class, 'transkip']);

Route::get('/ortuttd/{filename}', [App\Http\Controllers\ImageController::class, 'ortuTtd']);
Route::get('/ttd/{filename}', [App\Http\Controllers\ImageController::class, 'mabaTtd']);

Route::get('/info/{id}', App\Http\Livewire\ShowInfo::class)->name('info.show');

Route::post('/image-upload', [App\Http\Controllers\ImageController::class, 'upload'])->name('image.upload');