<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Kelas;
use App\Guru;
use App\Materi;
use App\Tugas;
use App\JoinKelas;
use App\Siswa;
use App\Jawaban;
use Auth;

class GuruController extends Controller
{
	public function dashboard(){
		$kelas = Kelas::where('id_guru', Auth::guard('guru')->user()->id)->get();
		
		return view('auth.guru.dashboard', compact('kelas'));
	}

	public function materi($id){
		$kelas = Kelas::where('id', $id)->get();
		$materi = Materi::where('id_kelas', $id)->get();

		return view('auth.guru.materi', compact('kelas','materi'));
	}

	public function materi_detail($id){
		$id_kelas = Materi::where('id', $id)->value('id_kelas');
		$materi = Materi::where('id', $id)->get();
		$kelas = Kelas::where('id', $id_kelas)->get();

		return view('auth.guru.materi-detail', compact('kelas','materi'));
	}

	public function tugas($id){
		$kelas = Kelas::where('id', $id)->get();
		$tugas = Tugas::where('id_kelas', $id)->get();

		return view('auth.guru.tugas', compact('kelas','tugas'));
	}

	public function tugas_detail($id){
		$id_kelas = Tugas::where('id', $id)->value('id_kelas');
		$tugas = Tugas::where('id', $id)->get();
		$kelas = Kelas::where('id', $id_kelas)->get();

		$join = JoinKelas::where('id_kelas', $id_kelas)->get();

		$lists = [];
		foreach ($join as $key) {
			$lists[] = [ $key->id_siswa ];
		}

		$siswa = Siswa::whereIn('id', $lists)->get();

		$jawaban = Jawaban::where('id_tugas', $id)->get();

		return view('auth.guru.tugas-detail', compact('kelas','tugas','siswa','jawaban'));
	}

	public function setting_kelas($id){
		$kelas = Kelas::where('id', $id)->get();
		$join = JoinKelas::where('id_kelas', $id)->get();

		$lists = [];
		foreach ($join as $key) {
			$lists[] = [ $key->id_siswa ];
		}

		$siswa = Siswa::whereIn('id', $lists)->get();

		return view('auth.guru.setting-kelas', compact('kelas','siswa'));
	}

	public function rekap($id){
		$kelas = Kelas::where('id', $id)->get();
		$join = JoinKelas::where('id_kelas', $id)->get();

		$lists = [];
		foreach ($join as $key) {
			$lists[] = [ $key->id_siswa ];
		}

		$siswa = Siswa::whereIn('id', $lists)->get();

		$tugas = Tugas::where('id_kelas', $id)->get();

		return view('auth.guru.rekap', compact('kelas','siswa','tugas'));
	}

	public function setting(){
		return view('auth.guru.setting');
	}

	public function setting_post(Request $request, $id){
		$post = Guru::find($id);

		$post->nama = $request->nama;
		$post->nip = $request->nip;
		$post->username = $request->username;
		$post->password = Hash::make($request->password);

		$post->save();

		return redirect()->back();
	}
}