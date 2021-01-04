<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JoinKelas;
use App\Kelas;

class JoinKelasController extends Controller
{
	public function store(Request $request){
		$cek=Kelas::where('kode', $request->kode)->count();

		if ($cek == 0) {

			alert()->error('Opps', 'Kode Kelas tidak ditemukan');
		} else {
			$id_kelas=Kelas::where('kode', $request->kode)->value("id");
			$kelas=Kelas::where('kode', $request->kode)->value("kelas");
			$cek2=JoinKelas::where('id_kelas', $id_kelas)->where('id_siswa', $request->id_siswa)->count();

			if ($cek2 != 0) {
				
				alert()->warning('Opss', 'Anda sudah bergabung '.$kelas.'');
			} else {
				$post = new JoinKelas();
				$post->id_kelas = $id_kelas;
				$post->id_siswa = $request->id_siswa;

				$post->save();

				alert()->success('Berhasil', 'Sekarang anda anggota kelas '.$kelas.'');
			};
		};

		return redirect()->back();
	}

	public function delete($id){
		$post = JoinKelas::find($id);

		$post->delete();

		return redirect()->back();
	}
}
