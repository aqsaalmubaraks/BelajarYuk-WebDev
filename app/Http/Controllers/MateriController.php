<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materi;

class MateriController extends Controller
{
    public function store(Request $request){
    	$post = new Materi();

    	$post->id_kelas = $request->id_kelas;
    	$post->judul = $request->judul;
    	$post->materi = $request->materi;

    	$post->save();

    	return redirect()->back();
    }

    public function edit(Request $request, $id){
    	$post = Materi::find($id);

    	$post->id_kelas = $request->id_kelas;
    	$post->judul = $request->judul;
    	$post->materi = $request->materi;

    	$post->save();

    	return redirect()->back();
    }

    public function delete($id){
    	$post = Materi::find($id);

    	$post->delete();

    	return redirect()->back();
    }
}
