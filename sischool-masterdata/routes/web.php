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

//ROUTE FOR KELAS
Route::get('/kelas', 'KelasController@index')->name('kelas');
Route::post('/kelas', 'KelasController@ajax_action_add_kelas');
Route::patch('/kelas', 'KelasController@ajax_action_edit_kelas');
Route::delete('/kelas', 'KelasController@ajax_action_delete_kelas');
Route::get('/kelas/ajax_get_kelas_by_id', 'KelasController@ajax_get_kelas_by_id');

//ROUTE FOR JURUSAN
Route::get('/jurusan', 'JurusanController@index');
Route::get('/jurusan/tambah', 'JurusanController@add_jurusan');
Route::post('/jurusan/tambah', 'JurusanController@ajax_action_add_jurusan');

//ROUTE FOR SISWA
Route::get('/siswa', 'SiswaController@index')->name('siswa');

//ROUTE FOR ORTU
Route::get('/ortu', 'OrtuController@index')->name('ortu');

//ROUTE FOR GURU
Route::get('/guru', 'GuruController@index')->name('guru');
Route::post('/guru', 'GuruController@ajax_action_add_guru');
Route::get('/guru/ajax_get_guru_by_id', 'GuruController@ajax_get_guru_by_id');