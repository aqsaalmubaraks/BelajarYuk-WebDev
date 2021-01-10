<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Guru;
use App\Siswa;
use App\Kelas;
use App\Admin;

use App\Materi;
use App\Tugas;
use App\JoinKelas;
use App\Jawaban;

class AdminController extends Controller
{
    public function dashboard(){
    	return view('auth.admin.dashboard');
    }

    public function guru(){
        $guru = Guru::all();

    	return view('auth.admin.guru', compact('guru'));
    }

    public function siswa(){
        $siswa = Siswa::all();

    	return view('auth.admin.siswa', compact('siswa'));
    }

    public function kelas(){
        $kelas = Kelas::all();

    	return view('auth.admin.kelas', compact('kelas'));
    }

    public function kelas_materi($id){
        $kelas = Kelas::where('id', $id)->get();
        $materi = Materi::where('id_kelas', $id)->get();

        return view('auth.admin.kelas-materi', compact('kelas','materi'));
    }

    public function kelas_tugas($id){
        $kelas = Kelas::where('id', $id)->get();
        $tugas = Tugas::where('id_kelas', $id)->get();

        return view('auth.admin.kelas-tugas', compact('kelas','tugas'));
    }

    public function kelas_tugas_detail($id){
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

        return view('auth.admin.kelas-tugas-detail', compact('kelas','tugas','siswa','jawaban'));
    }

    public function kelas_siswa($id){
        $kelas = Kelas::where('id', $id)->get();
        $join = JoinKelas::where('id_kelas', $id)->get();

        $lists = [];
        foreach ($join as $key) {
            $lists[] = [ $key->id_siswa ];
        }

        $siswa = Siswa::whereIn('id', $lists)->get();

        return view('auth.admin.kelas-siswa', compact('kelas','siswa'));
    }

    public function kelas_rekap($id){
        $kelas = Kelas::where('id', $id)->get();
        $join = JoinKelas::where('id_kelas', $id)->get();

        $lists = [];
        foreach ($join as $key) {
            $lists[] = [ $key->id_siswa ];
        }

        $siswa = Siswa::whereIn('id', $lists)->get();

        $tugas = Tugas::where('id_kelas', $id)->get();

        return view('auth.admin.kelas-rekap', compact('kelas','siswa','tugas'));
    }

    public function setting(){
        return view('auth.admin.setting');
    }

    public function setting_post(Request $request, $id){
        $post = Admin::find($id);

        $post->nama = $request->nama;
        $post->username = $request->username;
        $post->password = Hash::make($request->password);

        $post->save();

        return redirect()->back();
    }
}
