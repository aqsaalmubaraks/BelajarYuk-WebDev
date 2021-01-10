@extends('app-dashboard')

@section('title')
Siswa | Admin
@endsection

@section('content')

@foreach($siswa as $sw)
<ul id="dropdown-menu{{ $sw->id }}" class="dropdown-content left-align">
  <li><a class="modal-trigger" href="#modal-edit{{ $sw->id }}">Edit</a></li>
  <li><a class="modal-trigger" href="#modal-hapus{{ $sw->id }}">Hapus</a></li>
</ul>
@endforeach

<section>
  <div class="container-dashboard">
    <div class="title-page-dashboard">
      <div class="row nm">
        <div class="col s12 m12 l6">
          <h5>Siswa</h5>
        </div>

        <div class="col s12 m12 l6 right-align">

        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container-dashboard">
   <table id="tabel-siswa" class="display">
    <thead>
      <tr>
        <th style="width: 350px">Siswa</th>
        <th>Username</th>
        <th>Kelas</th>
        <th>Register At</th>
        <th style="width: 100px"></th>
      </tr>
    </thead>
    <tbody>

      @foreach($siswa as $sw)
      <tr>
        <td>
          <div class="img-wtext">
            <img src="https://materializecss.com/images/yuna.jpg" alt="" class="circle">
            <div class="text">
             <div><b>{{ $sw->nama }}</b></div>
             <div>{{ $sw->nis }}</div>
           </div>
         </div>
       </td>
       <td>{{ $sw->username }}</td>
       <td>{{ App\JoinKelas::where('id_siswa', $sw->id)->count() }}</td>
       <td>{{ date('j F Y', strtotime($sw->created_at)) }}</td>
       <td>
        <a class="btn-floating waves-effect waves-light btn-flat dropdown-trigger" href="#" data-target="dropdown-menu{{ $sw->id }}">
          <i class="material-icons">more_vert</i>
        </a>
      </td>
    </tr>
    @endforeach

  </tbody>
</table>
</div>
</section>


{{-- MODAL --}}
@foreach($siswa as $sw)
<div id="modal-edit{{ $sw->id }}" class="modal modal-full">
  <div class="modal-header row">
    <div class="col s11">
      <div class="img-wtext">
        <img src="https://materializecss.com/images/yuna.jpg" alt="" class="circle">
        <div class="text">
          <div><b>{{ $sw->nama }}</b></div>
          <div>{{ $sw->nis }}</div>
        </div>
      </div>
    </div>
    <div class="col s1 right-align">
      <button class="btn-floating waves-effect waves-light btn-flat modal-close"><i class="material-icons">close</i></button>
    </div>
  </div>
  <div class="modal-content">
    <div class="container w30">
      <div class="card-panel outlined nm mgb-3">

        <form action="{{ route('admin.siswa.edit', $sw->id) }}" method="POST">
          @csrf
          <div class="row">
            <div class="input-field col s12">
              <input placeholder="Nama" id="nama" type="text" class="validate" name="nama" value="{{ $sw->nama }}">
              <label for="nama">Nama</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input placeholder="NIS" id="nis" type="text" class="validate" name="nis" value="{{ $sw->nis }}">
              <label for="nis">NIS</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input placeholder="Kelas" id="nama" type="text" class="validate" name="kelas" value="{{ $sw->kelas }}">
              <label for="kelas">Kelas</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input placeholder="Username" id="username" type="text" class="validate" name="username" value="{{ $sw->username }}">
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
  </div>
</div>

<div id="modal-hapus{{ $sw->id }}" class="modal small">
  <div class="modal-content">
    <div class="title-page nm">
      <h4>Hapus Siswa</h4>
    </div>
    <br>

    <h6>Anda akan menghapus Siswa {{ $sw->nama }}</h6>

  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancel</a>
    <a href="{{ route('admin.siswa.delete', $sw->id) }}" class="waves-effect waves-green btn outlined danger">Hapus</a>
  </div>
</div>
@endforeach
@endsection

@section('js-plus')
<script type="text/javascript">


</script>
@endsection