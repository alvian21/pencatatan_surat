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

Route::get('/', 'AuthController@getLogin');
Route::post('/', 'AuthController@postLogin')->name('login');
Route::group(['middleware' => ['auth', 'CheckRole:kepsek']], function () {
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
        Route::get('karyawan', 'DashboardController@grafik_karyawan')->name('karyawan');
        Route::get('karyawan_dokumen', 'DashboardController@grafik_dokumen_karyawan')->name('karyawan_dokumen');
    });
    Route::resource('dashboard', 'DashboardController');
    Route::group(['prefix' => 'surat_masuk', 'as' => 'surat_masuk.'], function () {
        Route::get('download/{id}', 'SuratMasukController@download')->name('download');

        Route::post('update_surat', 'SuratMasukController@update_kepsek')->name('update_surat');
        Route::get('data_surat', 'SuratMasukController@getDataSurat')->name('data_surat');
    });

    Route::group(['prefix' => 'surat_keluar', 'as' => 'surat_keluar.'], function () {
        Route::get('download/{id}', 'SuratKeluarController@download')->name('download');

        Route::post('update_surat', 'SuratKeluarController@update_kepsek')->name('update_surat');
        Route::get('data_surat', 'SuratKeluarController@getDataSurat')->name('data_surat');
    });
    Route::resource('surat_masuk', 'SuratMasukController')->only(['index','show']);
    Route::resource('surat_keluar', 'SuratKeluarController')->only(['index','show']);

    Route::get('logout', 'AuthController@logout')->name('logout');
});
Route::group(['middleware' => ['auth', 'CheckRole:admin,kepsek']], function () {
    Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {
        Route::get('karyawan', 'DashboardController@grafik_karyawan')->name('karyawan');
        Route::get('karyawan_dokumen', 'DashboardController@grafik_dokumen_karyawan')->name('karyawan_dokumen');
    });
    Route::resource('dashboard', 'DashboardController');
    Route::resource('siswa', 'SiswaController');
    Route::resource('dokumentasi', 'DokumentasiController');
    Route::resource('karyawan', 'KaryawanController');
    Route::resource('sertifikat', 'SertifikatController');
    Route::group(['prefix' => 'surat_masuk', 'as' => 'surat_masuk.'], function () {
        Route::get('download/{id}', 'SuratMasukController@download')->name('download');
    });
    Route::group(['prefix' => 'surat_keluar', 'as' => 'surat_keluar.'], function () {
        Route::get('download/{id}', 'SuratKeluarController@download')->name('download');
        Route::get('generate', 'SuratKeluarController@generateKode')->name('generate');
    });
    Route::resource('surat_masuk', 'SuratMasukController');
    Route::resource('surat_keluar', 'SuratKeluarController');

    Route::get('logout', 'AuthController@logout')->name('logout');
});



