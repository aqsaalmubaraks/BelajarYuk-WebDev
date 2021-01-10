<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tugas;

class TugasController extends Controller
{
    public function store(Request $request){
    	$post = new Tugas();

    	$post->id_kelas = $request->id_kelas;
    	$post->judul = $request->judul;
    	$post->tugas = $request->tugas;

    	$post->deadline = $request->tanggal;
    	$post->jam = $request->waktu;

    	$post->save();

    	return redirect()->back();
    }

    public function edit(Request $request, $id){
    	$post = Tugas::find($id);

    	$post->id_kelas = $request->id_kelas;
    	$post->judul = $request->judul;
    	$post->tugas = $request->tugas;

    	$post->deadline = $request->tanggal;
    	$post->jam = $request->waktu;

    	$post->save();

    	return redirect()->back();
    }

    public function delete($id){
    	$post = Tugas::find($id);

    	$post->delete();

    	return redirect()->back();
    }
}
