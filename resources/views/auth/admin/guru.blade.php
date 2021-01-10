@extends('app-dashboard')

@section('title')
Guru | Admin
@endsection

@section('content')

@foreach($guru as $gr)
<ul id="dropdown-menu{{ $gr->id }}" class="dropdown-content left-align">
  <li><a class="modal-trigger" href="#modal-edit{{ $gr->id }}">Edit</a></li>
  <li><a class="modal-trigger" href="#modal-hapus{{ $gr->id }}">Hapus</a></li>
</ul>
@endforeach

<section>
  <div class="container-dashboard">
    <div class="title-page-dashboard">
      <div class="row nm">
        <div class="col s12 m12 l6">
          <h5>Guru</h5>
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
        <th style="width: 350px">Guru</th>
        <th>Username</th>
        <th>Kelas</th>
        <th>Register At</th>
        <th style="width: 100px"></th>
      </tr>
    </thead>
    <tbody>

      @foreach($guru as $gr)
      <tr>
        <td>
          <div class="img-wtext">
            <img src="https://materializecss.com/images/yuna.jpg" alt="" class="circle">
            <div class="text">
             <div><b>{{ $gr->nama }}</b></div>
             <div>{{ $gr->nip }}</div>
           </div>
         </div>
       </td>
       <td>{{ $gr->username }}</td>
       <td>{{ App\Kelas::where('id_guru', $gr->id)->count() }}</td>
       <td>{{ date('j F Y', strtotime($gr->created_at)) }}</td>
       <td>
        <a class="btn-floating waves-effect waves-light btn-flat dropdown-trigger" href="#" data-target="dropdown-menu{{ $gr->id }}">
          <i class="material-icons">more_vert</i>
        </a>
      </td>
    </tr>
    @endforeach

  </tr>
</tbody>
</table>
</div>
</section>


{{-- MODAL --}}
@foreach($guru as $gr)

<div id="modal-edit{{ $gr->id }}" class="modal modal-full">
  <div class="modal-header row">
    <div class="col s11">
      <div class="img-wtext">
        <img src="https://materializecss.com/images/yuna.jpg" alt="" class="circle">
        <div class="text">
          <div><b>{{ $gr->nama }}</b></div>
          <div>{{ $gr->nip }}</div>
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

        <form action="{{ route('admin.guru.edit', $gr->id) }}" method="POST">
          @csrf
          <div class="row">
            <div class="input-field col s12">
              <input placeholder="Nama" id="nama" type="text" class="validate" name="nama" value="{{ $gr->nama }}">
              <label for="nama">Nama</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input placeholder="NIP" id="nip" type="text" class="validate" name="nip" value="{{ $gr->nip }}">
              <label for="nip">NIP</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input placeholder="Username" id="username" type="text" class="validate" name="username" value="{{ $gr->username }}">
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

<div id="modal-hapus{{ $gr->id }}" class="modal small">

    <div class="modal-content">
      <div class="title-page nm">
        <h4>Hapus Guru</h4>
      </div>
      <br>

      <h6>Anda akan menghapus Guru {{ $gr->nama }}</h6>

    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancel</a>
      <a href="{{ route('admin.guru.delete', $gr->id) }}" class="waves-effect waves-green btn outlined danger">Hapus</a>
    </div>

</div>

@endforeach
@endsection

@section('js-plus')
<script type="text/javascript">

</script>
@endsection