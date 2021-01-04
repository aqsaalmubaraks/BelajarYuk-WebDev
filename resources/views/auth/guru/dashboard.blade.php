@extends('app-dashboard')
@section('title')
Dashboard | Guru
@endsection
@section('content')

@foreach($kelas as $kl)
<ul id="dropdown-menu{{ $kl->id }}" class="dropdown-content left-align">
  <li><a href="{{route('guru.setting_kelas', $kl->id)}}">Setting</a></li>
  <li><a href="{{route('guru.rekap', $kl->id)}}">Rekap</a></li>
</ul>
@endforeach

<div class="fixed-action-btn show-on-small hide-on-med-and-up">
  <a class="btn-floating btn-large primary modal-trigger" href="#modal-add-kelas">
    <i class="large material-icons">add</i>
  </a>
</div>

<section>
  <div class="container">

    <div class="title-page-dashboard">
      <div class="row nm">
        <div class="col s12 m12 l6">
          <h5>Dashboard</h5>
        </div>
        <div class="col s12 m12 l6 right-align">
          <a class="waves-effect waves-light btn outlined primary modal-trigger" href="#modal-add-kelas"><i class="material-icons right">add</i>New Kelas</a>
        </div>
      </div>
    </div>

    <div class="row">

      @foreach($kelas as $kl)
      <div class="col s12 m12 l4">
        <a href="{{route('guru.materi', $kl->id)}}">
          <div class="card outlined">
            <div class="card-title row nm">
              <div class="col s11">
                <div class="title">
                  <h6>{{ $kl->kelas }}</h6>
                </div>
              </div>
              <div class="col s1">
                <div class="menu">
                  <a class="btn-floating waves-effect waves-light btn-flat dropdown-trigger" href="#" data-target="dropdown-menu{{ $kl->id }}"><i class="material-icons">more_vert</i></a>
                </div>
              </div>
            </div>
            <div class="card-content ptb-1 center">
              <div class="badges flat primary-dark-text">
                <i class="material-icons">supervised_user_circle</i><span>{{ App\JoinKelas::where('id_kelas', $kl->id)->count() }} People</span>
              </div>
            </div>
          </div>
        </a>
      </div>
      @endforeach

    </div>

  </div>
</section>

<div id="modal-add-kelas" class="modal small">
  <form action="{{ route('guru.kelas.store') }}" method="POST">
    @csrf
    <div class="modal-content">
      <div class="title-page nm">
        <h4>New Kelas</h4>
      </div>
      <br>
      <div class="row">
        <div class="input-field col s12">
          <input id="nama_kelas" type="text" class="validate" name="kelas" required="">
          <label for="nama_kelas">Nama Kelas</label>
        </div>
      </div>

      <input type="hidden" name="id_guru" value="{{ Auth::guard('guru')->user()->id }}">
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancel</a>
      <button type="submit" class="waves-effect waves-green btn outlined primary">Submit</button>
    </div>
  </form>
</div>
@endsection