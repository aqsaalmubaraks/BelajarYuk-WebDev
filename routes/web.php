<?php

use Illuminate\Support\Facades\Route;

Route::prefix('siswa')->middleware('auth:siswa')->group(function () {

	Route::get('/', 'SiswaController@dashboard')->name('siswa.dashboard');
	Route::get('/setting', 'SiswaController@setting')->name('siswa.setting');
	Route::post('/setting/{id}', 'SiswaController@setting_post')->name('siswa.setting.edit');

	Route::prefix('kelas')->group(function () {
		Route::get('/materi/{id}', 'SiswaController@materi')->name('siswa.materi');
		Route::get('/materi/detail/{id}', 'SiswaController@materi_detail')->name('siswa.materi_detail');
		Route::get('/tugas/{id}', 'SiswaController@tugas')->name('siswa.tugas');
		Route::get('/tugas/detail/{id}', 'SiswaController@tugas_detail')->name('siswa.tugas_detail');
		Route::get('/setting/{id}', 'SiswaController@setting_kelas')->name('siswa.setting_kelas');
		Route::get('/rekap/{id}', 'SiswaController@rekap')->name('siswa.rekap');
	});

});