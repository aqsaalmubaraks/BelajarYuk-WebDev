<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Admin;
use App\Siswa;
use App\Guru;
use Auth;

class LoginController extends Controller
{
	public function getLogin()
	{
		return view('login');
	}

	public function register_siswa(){

		return view('register-siswa');
	}

	public function register_guru(){

		return view('register-guru');
	}

	public function postLogin(Request $request)
	{
		if (Auth::guard('guru')->attempt(['username' => $request->username, 'password' => $request->password])) {

			alert()->success('Hello', 'Guru '.$request->username.'');
			return redirect()->intended('/guru');

		} else if (Auth::guard('siswa')->attempt(['username' => $request->username, 'password' => $request->password])) {

			alert()->success('Hello', 'Siswa '.$request->username.'');
			return redirect()->intended('/siswa');

		} else if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password])) {

			alert()->success('Hello', 'Admin '.$request->username.'');
			return redirect()->intended('/admin');

		} else {

			return redirect()->intended('/');
		}
	}

	public function logout()
	{
		if (Auth::guard('admin')->check()) {
			Auth::guard('admin')->logout();
		} else if (Auth::guard('guru')->check()) {
			Auth::guard('guru')->logout();
		} else if (Auth::guard('siswa')->check()) {
			Auth::guard('siswa')->logout();	
		}

		alert()->success('See You', '');
		return redirect('/');
	}

	public function register_siswa_post(Request $request){
		$post = New Siswa();

		$post->nama = $request->nama;
		$post->nis = $request->nis;
		$post->kelas = $request->kelas;
		$post->username = $request->username;
		$post->password = Hash::make($request->password);

		$post->save();

		alert()->success('Berhasil', 'Registrasi Siswa Berhasil');
		return redirect()->back();
	}

	public function register_guru_post(Request $request){
		$post = New Guru();

		$post->nama = $request->nama;
		$post->nip = $request->nip;
		$post->username = $request->username;
		$post->password = Hash::make($request->password);

		$post->save();

		alert()->success('Berhasil', 'Registrasi Guru Berhasil');
		return redirect()->back();
	}

}