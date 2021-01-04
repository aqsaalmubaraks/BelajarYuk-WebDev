@extends('app-dashboard')

@section('title')
@foreach($kelas as $kl)
Setting Kelas {{ $kl->kelas }} | Guru
@endforeach
@endsection

@section('content')
@foreach($kelas as $kl)

<ul id="dropdown-menu" class="dropdown-content left-align">
  <li><a class="modal-trigger" href="#modal-hapus-siswa">Hapus</a></li>
</ul>

<ul id="dropdown-rekap" class="dropdown-content">
  <li><a id="ExportPDF" href="#!">PDF</a></li>
  <li><a id="ExportExcel" href="#!">Excel</a></li>
</ul>

<section class="mgb-3">
  <div class="container">

    <div class="title-page-dashboard mb-0">
      <div class="row nm">
        <div class="col s12 m12 l6">
          <h5>Setting Kelas</h5>
          <h6>Kelas {{ $kl->kelas }}</h6>
        </div>

        <div class="col s12 m12 l6 right-align">
        </div>
      </div>
    </div>
    <div class="row">
      <ul class="tabs">
        <li class="tab col s6"><a class="active" href="#setting">Setting</a></li>
        <li class="tab col s6"><a href="#anggota">Anggota</a></li>
      </ul>
    </div>

  </div>
</section>

<section id="setting">
  <div class="container">
    <table class="highlight">
      <tbody>
        <tr>
          <td>
            <div class="row nm">
              <div class="col s12 m12 l6">
                <b>Guru</b>
              </div>
              <div class="col s12 m12 l6">
                {{ App\Guru::where('id', $kl->id_guru)->value('nama') }}
              </div>
            </div>
          </td>
          <td style="width: 120px"></td>
        </tr>
        <tr>
          <td>
            <div class="row nm">
              <div class="col s12 m12 l6">
                <b>Nama Kelas</b>
              </div>
              <div class="col s12 m12 l6">
                Kelas {{ $kl->kelas }}
              </div>
            </div>
          </td>
          <td>  
            <a class="waves-effect waves-teal btn outlined modal-trigger" href="#modal-edit-kelas"><i class="material-icons left">edit</i>Edit</a>
          </td>
        </tr>
        <tr>
          <td>
            <div class="row nm">
              <div class="col s12 m12 l6">
                <b>Kode Kelas</b>
              </div>
              <div class="col s12 m12 l6">
                {{ $kl->kode }}
              </div>
            </div>
          </td>
          <td>
            <a class="waves-effect waves-teal btn outlined modal-trigger" href="#modal-edit-kode"><i class="material-icons left">replay</i>Ganti</a>
          </td>
        </tr>
      </tbody>
    </table>
    <br>
    <br>
    <div class="right-align">
      <a class="waves-effect waves-light btn outlined danger modal-trigger" href="#modal-hapus-kelas">Hapus Kelas</a>
    </div>
  </div>
</section>

<section id="anggota">
  <div class="container">

    <div class="row">
      <div class="col s12 m12 l6">
       <div class="input-field nm">
        <i class="material-icons prefix">search</i>
        <input placeholder="Search here" id="input-search" type="text" style="border: 0 !important; margin-bottom: 0">
      </div>
    </div>
    <div class="col s12 m12 l6 right-align">
      <a class="waves-effect waves-light btn outlined primary dropdown-trigger" data-target="dropdown-rekap">
        <i class="material-icons left">article</i>Rekap
      </a>
    </div>
  </div>

  <table id="tabel-siswa" class="display">
    <thead>
      <tr>
        <th>Siswa</th>
        <th style="width: 450px">Masuk</th>
        <th style="width: 40px"></th>
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
       <td>{{ date('j F Y', strtotime( App\JoinKelas::where('id_siswa', $sw->id)->value('created_at')) ) }}</td>
       <td>
         <a class="btn-floating waves-effect waves-light btn-flat dropdown-trigger" href="#" data-target="dropdown-menu"><i class="material-icons">more_vert</i></a>
       </td>
     </tr>
     @endforeach

   </tbody>
 </table>
</div>
</section>

{{-- MODAL --}}
<div id="modal-edit-kelas" class="modal small">
  <form action="{{ route('guru.kelas.edit', $kl->id) }}" method="POST">
    @csrf

    <div class="modal-content">
      <div class="title-page nm">
        <h4>Edit Kelas</h4>
      </div>
      <br>

      <div class="row">
        <div class="input-field col s12">
          <input id="nama_kelas" type="text" class="validate" name="kelas" required="" value="{{ $kl->kelas }}">
          <label for="nama_kelas">Nama Kelas</label>
        </div>
      </div>

      <input type="hidden" name="id_guru" value="{{ $kl->id_guru }}">
      <input type="hidden" name="kode" value="{{ $kl->kode }}">

    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancel</a>
      <button type="submit" class="waves-effect waves-green btn outlined primary">Submit</button>
    </div>
  </form>
</div>

<div id="modal-edit-kode" class="modal small">
  <form action="{{ route('guru.kelas.kode', $kl->id) }}" method="POST">
    @csrf

    <div class="modal-content">
      <div class="title-page nm">
        <h4>Ganti Kode Kelas</h4>
      </div>
      <br>

      <h6>Anda akan mengganti kode kelas {{ $kl->kelas }}</h6>

      <input type="hidden" name="id_guru" value="{{ $kl->id_guru }}">
      <input type="hidden" name="kelas" value="{{ $kl->kelas }}">

    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancel</a>
      <button type="submit" class="waves-effect waves-green btn outlined primary">Ganti</button>
    </div>
  </form>
</div>

<div id="modal-hapus-kelas" class="modal small">
  <form action="" method="">
    @csrf

    <div class="modal-content">
      <div class="title-page nm">
        <h4>Hapus Kelas</h4>
      </div>
      <br>

      <h6>Anda akan menghapus Kelas {{ $kl->kelas }} </h6>

    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancel</a>
      <a href="{{ route('guru.kelas.delete', $kl->id) }}" class="waves-effect waves-green btn outlined danger">Hapus</a>
    </div>
  </form>
</div>

<div id="modal-hapus-siswa" class="modal small">
  <form action="" method="">
    @csrf

    <div class="modal-content">
      <div class="title-page nm">
        <h4>Hapus Siswa</h4>
      </div>
      <br>

      <h6>Anda akan menghapus siswa ... dari kelas ...</h6>

    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancel</a>
      <button type="submit" class="waves-effect waves-green btn outlined danger">Hapus</button>
    </div>
  </form>
</div>

@endforeach
@endsection

@section('js-plus')
<script type="text/javascript">
  $(document).ready( function () {
    var table = $('#tabel-siswa').DataTable({
      "dom": 
      "<'row'<'col s12 m12 l12'tr>>" +
      "<'row'<'col s12 m12 l5'><'col s12 m12 l7'p>>",

      buttons: [
      {
        extend: 'excelHtml5',
        exportOptions: {
          columns: [ 0, 1]
        }
      },
      {
        extend: 'pdfHtml5',
        exportOptions: {
          columns: [ 0, 1]
        }
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