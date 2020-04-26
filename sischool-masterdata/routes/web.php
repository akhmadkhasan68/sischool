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
Route::get('/kelas/ajax_get_kelas', 'KelasController@ajax_get_kelas');
Route::post('/kelas', 'KelasController@ajax_action_add_kelas');
Route::patch('/kelas', 'KelasController@ajax_action_edit_kelas');
Route::delete('/kelas', 'KelasController@ajax_action_delete_kelas');
Route::get('/kelas/ajax_get_kelas_by_id', 'KelasController@ajax_get_kelas_by_id');

//ROUTE FOR MAPEL
Route::get('/mapel', 'MapelController@index');
Route::get('/mapel/ajax_get_mapel', 'MapelController@ajax_get_mapel');
Route::get('/mapel/ajax_get_mapel_by_id', 'MapelController@ajax_get_mapel_by_id');
Route::post('/mapel/ajax_action_add_mapel', 'MapelController@ajax_action_add_mapel');
Route::patch('/mapel', 'MapelController@ajax_action_edit');
Route::delete('mapel', 'MapelController@ajax_action_delete');



//ROUTE FOR JURUSAN
Route::get('/jurusan', 'JurusanController@index');
Route::get('/jurusan/ajax_get_jurusan', 'JurusanController@ajax_get_jurusan');
Route::delete('/jurusan', 'JurusanController@ajax_action_delete_jurusan');
Route::get('/jurusan/tambah', 'JurusanController@add_jurusan');
Route::post('/jurusan/tambah', 'JurusanController@ajax_action_add_jurusan');
Route::patch('/jurusan/edit', 'JurusanController@ajax_action_edit_jurusan');
Route::get('kelas/edit/{id}', 'JurusanController@edit_jurusan');

//ROUTE FOR SISWA
Route::get('/siswa', 'SiswaController@index')->name('siswa');

//ROUTE FOR ORTU
Route::get('/ortu', 'OrtuController@index')->name('ortu');

//ROUTE FOR GURU
Route::get('/guru', 'GuruController@index')->name('guru');
Route::get('/guru/ajax_get_guru', 'GuruController@ajax_get_guru');
Route::post('/guru', 'GuruController@ajax_action_add_guru');
Route::get('/guru/ajax_get_guru_by_id', 'GuruController@ajax_get_guru_by_id');
Route::delete('/guru', 'GuruController@ajax_action_delete_guru');
Route::patch('/guru', 'GuruController@ajax_action_edit_guru');

//ROUTE FOR MAPEL GURU
Route::get('/mapel_guru', 'MapelGuruController@index');
Route::get('/mapel_guru/ajax_get_mapel', 'MapelGuruController@ajax_get_mapel');
Route::post('/mapel_guru', 'MapelGuruController@ajax_action_add');

//ROUTE FOR PENGATURAN SEKOLAH
Route::get('/pengaturan_sekolah', 'SekolahSettingController@index');
Route::patch('/pengaturan_sekolah', 'SekolahSettingController@ajax_action_update_sekolah');
Route::patch('/pengaturan_sekolah/update_ppdb', 'SekolahSettingController@ajax_action_update_ppdb');

//ROUTE FOR PENGATURAN AKUN
Route::get('/pengaturan_akun', 'AccountSettingController@index');
Route::patch('/pengaturan_akun', 'AccountSettingController@ajax_action_edit_account');