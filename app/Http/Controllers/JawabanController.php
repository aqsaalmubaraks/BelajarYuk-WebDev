<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jawaban;

class JawabanController extends Controller
{
	public function store(Request $request){
		$post = new Jawaban();

		$post->id_tugas = $request->id_tugas;
		$post->id_siswa = $request->id_siswa;
		$post->jawaban = $request->jawaban;
		$post->nilai = null;

		$post->save();

		return redirect()->back();
	}

	public function edit(Request $request, $id){
		$post = Jawaban::find($id);

		$post->id_tugas = $request->id_tugas;
		$post->id_siswa = $request->id_siswa;
		$post->jawaban = $request->jawaban;

		$post->save();

		return redirect()->back();
	}

	public function nilai(Request $request, $id){
		$post = Jawaban::find($id);

		$post->id_tugas = $request->id_tugas;
		$post->id_siswa = $request->id_siswa;
		$post->jawaban = $request->jawaban;
		$post->nilai = $request->nilai;

		$post->save();

		return redirect()->back();
	}
}
