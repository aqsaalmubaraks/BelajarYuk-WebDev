<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Kelas;

class KelasController extends Controller
{
	public function store(Request $request){
		$post = New Kelas();

		$post->id_guru = $request->id_guru;
		$post->kelas = $request->kelas;
		$post->kode = Str::random(7);

		$post->save();

		return redirect()->back();
	}

	public function edit(Request $request, $id){
		$post = Kelas::find($id);

		$post->id_guru = $request->id_guru;
		$post->kelas = $request->kelas;
		$post->kode = $request->kode;

		$post->save();

		return redirect()->back();
	}

	public function kode(Request $request, $id){
		$post = Kelas::find($id);

		$post->id_guru = $request->id_guru;
		$post->kelas = $request->kelas;
		$post->kode = Str::random(7);

		$post->save();

		return redirect()->back();
	}

	public function delete($id){
		$post = Kelas::find($id);

		$post->delete();

		return redirect()->route('guru.dashboard');
	}
}
