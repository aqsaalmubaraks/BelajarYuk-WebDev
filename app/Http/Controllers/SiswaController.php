<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\kelas;
use App\JoinKelas;
use App\Materi;
use App\Tugas;
use App\Jawaban;
use App\Siswa;
use Auth;

class SiswaController extends Controller
{
    public function dashboard(){
        $list_kelas = JoinKelas::where('id_siswa', Auth::guard('siswa')->user()->id)->get();
        $lists = [];
        foreach ($list_kelas as $key) {
            $lists[] = [ $key->id_kelas ];
        }
        $kelas = Kelas::whereIn('id', $lists)->get();

        return view('auth.siswa.dashboard', compact('kelas'));
    }

    public function materi($id){
        $kelas = Kelas::where('id', $id)->get();
        $materi = Materi::where('id_kelas', $id)->get();

        return view('auth.siswa.materi', compact('kelas','materi'));
    }

    public function materi_detail($id){
        $id_kelas = Materi::where('id', $id)->value('id_kelas');
        $materi = Materi::where('id', $id)->get();
        $kelas = Kelas::where('id', $id_kelas)->get();

        return view('auth.siswa.materi-detail', compact('kelas','materi'));
    }

    public function tugas($id){
        $kelas = Kelas::where('id', $id)->get();
        $tugas = Tugas::where('id_kelas', $id)->get();

        return view('auth.siswa.tugas', compact('kelas','tugas'));
    }

    public function tugas_detail($id){
        $id_kelas = Tugas::where('id', $id)->value('id_kelas');
        $tugas = Tugas::where('id', $id)->get();
        $kelas = Kelas::where('id', $id_kelas)->get();

        $cek = Jawaban::where('id_tugas', $id)->where('id_siswa', Auth::guard('siswa')->user()->id)->count();
        if ($cek != 0) {
            $jawaban = Jawaban::where('id_tugas', $id)->where('id_siswa', Auth::guard('siswa')->user()->id)->get();

            return view('auth.siswa.tugas-detail', compact('kelas','tugas','cek','jawaban'));
        } else {

            return view('auth.siswa.tugas-detail', compact('kelas','tugas','cek'));
        }
    }

    public function rekap($id){
        $kelas = Kelas::where('id', $id)->get();
        $tugas = Tugas::where('id_kelas', $id)->get();

        return view('auth.siswa.rekap', compact('kelas','tugas'));
    }

    public function setting_kelas($id){
        $kelas = Kelas::where('id', $id)->get();

        return view('auth.siswa.setting-kelas', compact('kelas'));
    }

    public function setting(){
        return view('auth.siswa.setting');
    }

    public function setting_post(Request $request, $id){
        $post = Siswa::find($id);

        $post->nama = $request->nama;
        $post->nis = $request->nis;
        $post->kelas = $request->kelas;
        $post->username = $request->username;
        $post->password = Hash::make($request->password);

        $post->save();

        return redirect()->back();
    }
}
