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

	Route::prefix('be')->group(function () {
		Route::prefix('jawaban')->group(function () {
			Route::post('/store', 'JawabanController@store')->name('siswa.jawaban.store');
			Route::post('/edit/{id}', 'JawabanController@edit')->name('siswa.jawaban.edit');
		});
	});	
});

Route::prefix('guru')->middleware('auth:guru')->group(function () {

	Route::get('/', 'GuruController@dashboard')->name('guru.dashboard');
	Route::get('/setting', 'GuruController@setting')->name('guru.setting');
	
	Route::prefix('kelas')->group(function () {
		Route::get('/materi/{id}', 'GuruController@materi')->name('guru.materi');
		Route::get('/materi/detail/{id}', 'GuruController@materi_detail')->name('guru.materi_detail');
		Route::get('/tugas/{id}', 'GuruController@tugas')->name('guru.tugas');
		Route::get('/tugas/detail/{id}', 'GuruController@tugas_detail')->name('guru.tugas_detail');
		Route::get('/setting/{id}', 'GuruController@setting_kelas')->name('guru.setting_kelas');
		Route::get('/rekap/{id}', 'GuruController@rekap')->name('guru.rekap');
	});

	Route::prefix('be')->group(function () {
		Route::prefix('materi')->group(function () {
			Route::post('/store', 'MateriController@store')->name('guru.materi.store');
			Route::get('/delete/{id}', 'MateriController@delete')->name('guru.materi.delete');
			Route::post('/edit/{id}', 'MateriController@edit')->name('guru.materi.edit');
		});
		Route::prefix('tugas')->group(function () {
			Route::post('/store', 'TugasController@store')->name('guru.tugas.store');
			Route::get('/delete/{id}', 'TugasController@delete')->name('guru.tugas.delete');
			Route::post('/edit/{id}', 'TugasController@edit')->name('guru.tugas.edit');
		});
		Route::prefix('nilai')->group(function () {
			Route::post('/jawaban/nilai/{id}', 'JawabanController@nilai')->name('guru.jawaban.nilai');
		});
	});
	
});