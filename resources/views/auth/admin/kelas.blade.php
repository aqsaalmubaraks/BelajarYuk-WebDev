@extends('app-dashboard')

@section('title')
Kelas | Admin
@endsection

@section('content')

@foreach($kelas as $kl)
<ul id="dropdown-menu{{ $kl->id }}" class="dropdown-content left-align">
  <li><a class="modal-trigger" href="{{route('admin.kelas.rekap', $kl->id)}}">Rekap</a></li>
  <li><a class="modal-trigger" href="#modal-edit{{ $kl->id }}">Edit</a></li>
  <li><a class="modal-trigger" href="#modal-hapus{{ $kl->id }}">Hapus</a></li>
</ul>
@endforeach

<section>
  <div class="container-dashboard">
    <div class="title-page-dashboard">
      <div class="row nm">
        <div class="col s12 m12 l6">
          <h5>Kelas</h5>
        </div>

        <div class="col s12 m12 l6 right-align">

        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container-dashboard">
   <table id="tabel-kelas" class="display">
    <thead>
      <tr>
        <th>Kelas</th>
        <th style="width: 250px">Guru</th>
        <th>Materi</th>
        <th>Tugas</th>
        <th>Siswa</th>
        <th>Created At</th>
        <th style="width: 100px"></th>
      </tr>
    </thead>
    <tbody>

      @foreach($kelas as $kl)
      <tr>
        <td>{{ $kl->kelas }}</td>
        <td>
          <div class="img-wtext">
            <img src="https://materializecss.com/images/yuna.jpg" alt="" class="circle">
            <div class="text">
              <div><b>{{ App\Guru::where('id', $kl->id_guru)->value('nama') }}</b></div>
              <div>{{ App\Guru::where('id', $kl->id_guru)->value('nip') }}</div>
            </div>
          </div>
        </td>
        <td>
          <a class="waves-effect waves btn-flat" href="{{route('admin.kelas.materi', $kl->id)}}" >
            <i class="material-icons left">article</i>{{ App\Materi::where('id_kelas', $kl->id)->count() }}
          </a>
        </td>
        <td>
          <a class="waves-effect waves btn-flat" href="{{route('admin.kelas.tugas', $kl->id)}}">
            <i class="material-icons left">assignment</i>{{ App\Tugas::where('id_kelas', $kl->id)->count() }}
          </a>
        </td>
        <td>
          <a class="waves-effect waves btn-flat" href="{{route('admin.kelas.siswa', $kl->id)}}">
            <i class="material-icons left">face</i>{{ App\JoinKelas::where('id_kelas', $kl->id)->count() }}
          </a>
        </td>
        <td>{{ date('j F Y', strtotime($kl->created_at)) }}</td>
        <td>
          <a class="btn-floating waves-effect waves-light btn-flat dropdown-trigger" href="#" data-target="dropdown-menu{{ $kl->id }}">
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
@foreach($kelas as $kl)
<div id="modal-edit{{ $kl->id }}" class="modal modal-full">
  <div class="modal-header row">
    <div class="col s11">
      <h5>Kelas {{ $kl->kelas }}</h5>
      <h6>{{ App\Guru::where('id', $kl->id_guru)->value('nama') }} | NIP: {{ App\Guru::where('id', $kl->id_guru)->value('nip') }}</h6>
    </div>
    <div class="col s1 right-align">
      <button class="btn-floating waves-effect waves-light btn-flat modal-close"><i class="material-icons">close</i></button>
    </div>
  </div>
  <div class="modal-content">
    <div class="container w30">
      <div class="card-panel outlined nm mgb-3">
        <form action="{{ route('admin.kelas.edit', $kl->id) }}" method="POST">
          @csrf
          <div class="row">
            <div class="input-field col s12">
              <input placeholder="Nama Kelas" id="nama_kelas" name="kelas" type="text" class="validate" value="{{ $kl->kelas }}">
              <label for="nama_kelas">Nama Kelas</label>
            </div>
          </div>

          <input type="hidden" name="id_guru" value="{{ $kl->id_guru }}">
          <input type="hidden" name="kode" value="{{ $kl->kode }}">

          <div class="row">
            <div class="input-field col s12 right-align">
              <button type="submit" class="waves-effect waves-light btn outlined primary"><i class="material-icons right">send</i>Submit</button>
            </div>
          </div>
        </form>


      </div>
      <div class="card-panel outlined nm mgb-3">
        <form action="{{ route('admin.kelas.kode', $kl->id) }}" method="POST">
          @csrf

          <input type="hidden" name="id_guru" value="{{ $kl->id_guru }}">
          <input type="hidden" name="kelas" value="{{ $kl->kelas }}">

          <div class="row">
            <div class="input-field col s12">
              <input placeholder="Nama Kelas" id="nama_kelas" type="text" class="validate" disabled="" value="{{ $kl->kode }}">
              <label for="nama_kelas">Kode Kelas</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12 right-align">
              <button type="submit" class="waves-effect waves-light btn outlined primary"><i class="material-icons right">replay</i>Ganti</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

{{-- <div id="modal-rekap" class="modal modal-full">
  <div class="modal-header row">
    <div class="col s11">
      <h5>Nama Kelas</h5>
      <h6>Nama Guru | NIP Guru</h6>
    </div>
    <div class="col s1 right-align">
      <button class="btn-floating waves-effect waves-light btn-flat modal-close"><i class="material-icons">close</i></button>
    </div>
  </div>
  <div class="modal-content">
    <div class="container">
      <table id="tabel-rekap" class="display" width="180%">
        <thead>
          <tr>
            <th>Siswa</th>
            <th class="center">Tugas 1</th>
            <th class="center">Tugas 2</th>
            <th class="center">Tugas 1</th>
            <th class="center">Tugas 2</th>
            <th class="center">Tugas 1</th>
            <th class="center">Tugas 2</th>
            <th class="center">Tugas 1</th>
            <th class="center">Tugas 2</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <div class="img-wtext">
                <img src="https://materializecss.com/images/yuna.jpg" alt="" class="circle" />
                <div class="text"><b>Nama Siswa</b><br>NIS Siswa</div>
              </div>
            </td>
            <td class="center">100</td>
            <td class="center">100</td>
            <td class="center">100</td>
            <td class="center">100</td>
            <td class="center">100</td>
            <td class="center">100</td>
            <td class="center">100</td>
            <td class="center">100</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div> --}}

<div id="modal-hapus{{ $kl->id }}" class="modal small">
  <div class="modal-content">
    <div class="title-page nm">
      <h4>Hapus Kelas</h4>
    </div>
    <br>

    <h6>Anda akan menghapus Kelas {{ $kl->kelas }}</h6>

  </div>
  <div class="modal-footer">
    <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancel</a>
    <a href="{{ route('admin.kelas.delete', $kl->id) }}" class="waves-effect waves-green btn outlined danger">Hapus</a>
  </div>
</div>
@endforeach
@endsection

@section('js-plus')
<script type="text/javascript">
  $(document).ready( function () {
    var table = $('#tabel-rekap').DataTable({
      "dom": 
      "<'row'<'col s12 m12 l12'tr>>",

      scrollX:        true,
      scrollCollapse: true,
      paging:         false,
      fixedColumns:   {
        leftColumns: 1
      },

      buttons: [
      {
        extend: 'excelHtml5'
      },
      {
        extend: 'pdfHtml5'
      },
      ],

    });

    tabelsearch = $('#tabel-siswa').DataTable();
    $('#input-search').keyup(function(){
      tabelsearch.search($(this).val()).draw();
    });

    $("#ExportPDF").on("click", function() {
      table.button( '.buttons-pdf' ).trigger();
    });

    $("#ExportExcel").on("click", function() {
      table.button( '.buttons-excel' ).trigger();
    });
  });
</script>
@endsection