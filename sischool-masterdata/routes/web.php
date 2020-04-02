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

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/kelas', 'KelasController@index')->name('kelas');
Route::post('/kelas', 'KelasController@ajax_action_add_kelas');
Route::delete('/kelas', 'KelasController@ajax_action_delete_kelas');

Route::get('/jurusan', 'JurusanController@index');
Route::get('/jurusan/tambah', 'JurusanController@add_jurusan');
Route::post('/jurusan/tambah', 'JurusanController@proses_insert');

Route::get('/siswa', 'SiswaController@index')->name('siswa');

Route::get('/ortu', 'OrtuController@index')->name('ortu');
