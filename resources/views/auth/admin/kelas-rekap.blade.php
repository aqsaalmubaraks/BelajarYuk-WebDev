@extends('app-dashboard')

@section('title')
Kelas-Rekap | Admin
@endsection

@section('content')
@foreach($kelas as $kl)

<ul id="dropdown-rekap" class="dropdown-content">
  <li><a id="ExportPDF" href="#!">PDF</a></li>
  <li><a id="ExportExcel" href="#!">Excel</a></li>
</ul>

<section>
  <div class="container-dashboard">
    <div class="title-page-dashboard">
      <div class="row nm">
        <div class="col s12 m12 l6">
          <h5>Kelas {{ $kl->kelas }} - Rekap</h5>
        </div>

        <div class="col s12 m12 l6 right-align">

        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container-dashboard">

    <div id="table-rekap" class="table-scroll">
      <div class="table-wrap">
        <table id="tabel-rekap" class="main-table">

          <thead>
            <tr>
              <th class="fixed-side" scope="col">Siswa</th>

              @foreach($tugas as $tg)
              <th style="width: 200px">{{ $tg->judul }}</th>
              @endforeach

            </tr>
          </thead>
          <tbody>

            @foreach($siswa as $sw)
            <tr>
              <td class="fixed-side">
                <div class="img-wtext white" style="width: 200px">
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
    </div>
  </div>
</section>


{{-- MODAL --}}

@endforeach
@endsection

@section('js-plus')
<script type="text/javascript">
  jQuery(document).ready(function() {
   jQuery(".main-table").clone(true).appendTo('#table-rekap').addClass('clone');   
 });
</script>
@endsection