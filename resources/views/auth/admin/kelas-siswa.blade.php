@extends('app-dashboard')

@section('title')
Kelas-Siswa | Admin
@endsection

@section('content')
@foreach($kelas as $kl)

@foreach($siswa as $sw)
<ul id="dropdown-menu{{ $sw->id }}" class="dropdown-content left-align">
  <li><a class="modal-trigger" href="#modal-hapus-siswa{{ $sw->id }}">Hapus</a></li>
</ul>
@endforeach

<section>
  <div class="container-dashboard">
    <div class="title-page-dashboard">
      <div class="row nm">
        <div class="col s12 m12 l6">
          <h5>Kelas {{ $kl->kelas }} - Siswa</h5>
        </div>

        <div class="col s12 m12 l6 right-align">

        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container-dashboard">
    <div class="row">
      <div class="col s12 m12 l6">
       <div class="input-field nm">
        <i class="material-icons prefix">search</i>
        <input placeholder="Search here" id="input-search" type="text" style="border: 0 !important; margin-bottom: 0">
      </div>
    </div>
    <div class="col s12 m12 l6 right-align">
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
              <div>NIS {{ $sw->nis }}</div>
            </div>
          </div>
        </td>

        <td>{{ date('j F Y', strtotime( App\JoinKelas::where('id_siswa', $sw->id)->value('created_at')) ) }}</td>
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
<div id="modal-hapus-siswa{{ $sw->id }}" class="modal small">
  <form action="{{ route('admin.join.delete') }}" method="POST">
    @csrf

    <div class="modal-content">
      <div class="title-page nm">
        <h4>Hapus Siswa</h4>
      </div>
      <br>

      <h6>Anda akan menghapus siswa {{ $sw->nama }} dari kelas {{ $kl->kelas }}</h6>

      <input type="hidden" name="id_siswa" value="{{ $sw->id }}">
      <input type="hidden" name="id_kelas" value="{{ $kl->id }}}">
      <input type="hidden" name="auth" value="guru">

    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancel</a>
      <button type="submit" class="waves-effect waves-green btn outlined danger">Hapus</button>
    </div>
  </form>
</div>
@endforeach

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