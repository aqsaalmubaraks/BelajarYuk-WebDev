@extends('app-dashboard')

@section('title')
Setting | Guru
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
      <form action="{{ route('guru.setting.edit', Auth::guard('guru')->user()->id) }}" method="POST">
        @csrf
        <div class="row">
          <div class="input-field col s12">
            <input placeholder="Nama" id="nama" type="text" class="validate" name="nama" value="{{ Auth::guard('guru')->user()->nama }}">
            <label for="nama">Nama</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input placeholder="NIP" id="nip" type="text" class="validate" name="nip" value="{{ Auth::guard('guru')->user()->nip }}">
            <label for="nip">NIP</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input placeholder="Username" id="username" type="text" class="validate" name="username" value="{{ Auth::guard('guru')->user()->username }}">
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