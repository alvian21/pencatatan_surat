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

Route::group(['middleware' => 'auth'], function () {
    Route::resource('dashboard', 'DashboardController');
    Route::resource('siswa', 'SiswaController');

    Route::get('logout', 'AuthController@logout')->name('logout');
});
