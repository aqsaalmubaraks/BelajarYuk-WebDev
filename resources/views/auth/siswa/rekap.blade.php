@extends('app-dashboard')

@section('title')
@foreach($kelas as $kl)
Rekap Kelas {{ $kl->kelas }} | Siswa
@endforeach
@endsection

@section('content')
@foreach($kelas as $kl)

<ul id="dropdown-rekap" class="dropdown-content">
  <li><a id="ExportPDF" href="#!">PDF</a></li>
  <li><a id="ExportExcel" href="#!">Excel</a></li>
</ul>

<section>
  <div class="container">
    <div class="title-page-dashboard">
      <div class="row nm">
        <div class="col s12 m12 l6">
          <h5>Rekap</h5>
          <h6>Kelas {{ $kl->kelaas }} | By {{ App\Guru::where('id', $kl->id_guru)->value('nama') }}</h6>
        </div>

        <div class="col s12 m12 l6 right-align">
        </div>
      </div>
    </div>
  </div>
</section>

<section>
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

  <table id="tabel-rekap" class="display" style="width: 100%">
    <thead>
      <tr>
        <th>Tugas</th>
        <th>Nilai</th>
      </tr>
    </thead>
    <tbody>

      @foreach($tugas as $tg)
      <tr>
        <th>{{ $tg->judul }}</th>
        <td>
          {{ 
            App\Jawaban::where('id_tugas', $tg->id)
            ->where('id_siswa', Auth::guard('siswa')->user()->id)
            ->value('nilai') 
          }}
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

</div>
</section>

@endforeach
@endsection

@section('js-plus')
<script type="text/javascript">
  $(document).ready( function () {
    var table = $('#tabel-rekap').DataTable({
      "dom": 
      "<'row'<'col s12 m12 l12'tr>>" +
      "<'row'<'col s12 m12 l5'><'col s12 m12 l7'p>>",

      buttons: [
      {
        extend: 'excelHtml5'
      },
      {
        extend: 'pdfHtml5'
      },
      ],

    });

    tabelsearch = $('#tabel-rekap').DataTable();
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