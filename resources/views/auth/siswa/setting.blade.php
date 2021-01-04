@extends('app-dashboard')

@section('title')
Setting | Siswa
@endsection

@section('content')

<section>
  <div class="container">
    <div class="title-page-dashboard">
      <div class="row nm">
        <div class="col s12 m12 l6">
          <h5>Setting Akun</h5>
        </div>
        <div class="col s12 m12 l6 right-align">
          <a class="waves-effect waves-light btn outlined danger" href="/logout"><i class="material-icons left">power_settings_new</i>Logout</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container w30">
    <div class="card-panel outlined nm mgb-3">
      <form action="{{ route('siswa.setting.edit', Auth::guard('siswa')->user()->id) }}" method="POST">
        @csrf
        <div class="row">
          <div class="input-field col s12">
            <input placeholder="Nama" id="nama" type="text" class="validate" name="nama" value="{{ Auth::guard('siswa')->user()->nama }}">
            <label for="nama">Nama</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input placeholder="NIS" id="nis" type="text" class="validate" name="nis" value="{{ Auth::guard('siswa')->user()->nis }}">
            <label for="nis">NIS</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input placeholder="Kelas" id="nama" type="text" class="validate" name="kelas" value="{{ Auth::guard('siswa')->user()->kelas }}">
            <label for="kelas">Kelas</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input placeholder="Username" id="username" type="text" class="validate" name="username" value="{{ Auth::guard('siswa')->user()->username }}">
            <label for="username">Username</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input placeholder="Password" id="password" type="password" class="validate" name="password">
            <label for="password">Password</label>
          </div>
        </div>
        <div class="row">
          <div class="file-field input-field col s12">
            <div class="btn outlined primary">
              <span>Foto</span>
              <input type="file" name="foto" multiple>
            </div>
            <div class="file-path-wrapper">
              <input class="file-path validate" type="text" placeholder="Upload Foto" name="foto">
            </div>
          </div>
        </div>
        <div class="row nm">
          <div class="input-field col s12 right-align">
            <button type="submit" class="waves-effect waves-light btn btn-large primary-dark outlined">Submit</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

@endsection