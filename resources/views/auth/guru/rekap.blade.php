@extends('app-dashboard')
@section('title')
@foreach($kelas as $kl)
Rekap Kelas {{ $kl->kelas }} | Guru
@endforeach
@endsection
@section('content')
@foreach($kelas as $kl)

<ul id="dropdown-export" class="dropdown-content">
  <li><a id="ExportPDF" href="#!">PDF</a></li>
  <li><a id="ExportExcel" href="#!">Excel</a></li>
</ul>

<section>
  <div class="container">
    <div class="title-page-dashboard">
      <div class="row nm">
        <div class="col s12 m12 l6">
          <h5>Rekap</h5>
          <h6>Kelas {{ $kl->kelas }}</h6>
        </div>
        <div class="col s12 m12 l6 right-align">
          <a href="#!" data-target="dropdown-export" class="waves-effect waves-light btn outlined primary dropdown-trigger"><i class="material-icons left">description</i>Rekap</a>
        </div>
      </div>
    </div>
  </div>
</section>
<section>
  <div class="container">
    <table id="tabel-rekap" class="display" width="180%">
      <thead>
        <tr>
          <th>Siswa</th>

          @foreach($tugas as $tg)
          <th class="center">{{ $tg->judul }}</th>
          @endforeach

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

          @foreach($tugas as $tg)

          @php
          $cek = App\Jawaban::where('id_tugas', $tg->id)->where('id_siswa', $sw->id)->count();
          $nilai = 0;

          if ($cek == 0) {

            $nilai = 0;

          } else {

            $nilai = App\Jawaban::where('id_tugas', $tg->id)->where('id_siswa', $sw->id)->value('nilai');

          }
          @endphp

          <td class="center">{{ $nilai }}</td>

          @endforeach

        </tr>
        @endforeach

      </tbody>
    </table>
  </div>
</section>
{{-- MODAL --}}

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