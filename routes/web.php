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
    Route::resource('dashboard', 'DashboardController');
    Route::group(['prefix' => 'surat_masuk', 'as' => 'surat_masuk.'], function () {
        Route::get('download/{id}', 'SuratMasukController@download')->name('download');

        Route::post('update_surat', 'SuratMasukController@update_kepsek')->name('update_surat');
        Route::get('data_surat', 'SuratMasukController@getDataSurat')->name('data_surat');
    });
    Route::resource('surat_masuk', 'SuratMasukController')->only(['index','show']);

    Route::get('logout', 'AuthController@logout')->name('logout');
});
Route::group(['middleware' => ['auth', 'CheckRole:admin,kepsek']], function () {
    Route::resource('dashboard', 'DashboardController');
    Route::resource('siswa', 'SiswaController');
    Route::resource('dokumentasi', 'DokumentasiController');
    Route::resource('karyawan', 'KaryawanController');
    Route::resource('sertifikat', 'SertifikatController');
    Route::group(['prefix' => 'surat_masuk', 'as' => 'surat_masuk.'], function () {
        Route::get('download/{id}', 'SuratMasukController@download')->name('download');
    });
    Route::resource('surat_masuk', 'SuratMasukController');

    Route::get('logout', 'AuthController@logout')->name('logout');
});



