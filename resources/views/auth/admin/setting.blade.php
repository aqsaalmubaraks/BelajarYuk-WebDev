@extends('app-dashboard')

@section('title')
Setting | Admin
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

        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container w30">
    <div class="card-panel outlined nm mgb-3">
      <form action="{{ route('admin.setting.edit', Auth::guard('admin')->user()->id) }}" method="POST">
        @csrf
        <div class="row">
          <div class="input-field col s12">
            <input placeholder="Username" id="nama" type="text" class="validate" name="nama" value="{{ Auth::guard('admin')->user()->nama }}">
            <label for="nama">Nama</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input placeholder="Username" id="username" type="text" class="validate" name="username" value="{{ Auth::guard('admin')->user()->username }}">
            <label for="username">Username</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input placeholder="Password" id="password" type="password" class="validate" name="password">
            <label for="password">Password</label>
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