@extends('app-dashboard')

@section('title')
@foreach($kelas as $kl)
Tugas Kelas | Siswa
@endforeach
@endsection

@section('content')
@foreach($kelas as $kl)
<section>
  <div class="container">

    <div class="title-page-dashboard">
      <div class="row nm">
        <div class="col s12 m12 l6">
          <h5>Tugas</h5>
          <h6>Kelas {{ $kl->kelas }} | By {{ App\Guru::where('id', $kl->id_guru)->value('nama') }}</h6>
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

      @foreach($tugas as $tg)
      <div class="col s12">
        <a href="{{route('siswa.tugas_detail', $tg->id)}}">
          <div class="card outlined">
            <div class="card-title row nm">
              <div class="col s11">
                <div class="title">
                  <h6>{{ $tg->judul }}</h6>
                </div>
              </div>
              <div class="col s1">
              </div>
            </div>

            <div class="card-content ptb-1">
              <div class="row nm">
                <div class="col s12 m12 l6 left-align">
                   Deadline At {{ date('H:i', strtotime($tg->jam)) }}, {{ date('j F Y', strtotime($tg->deadline)) }}
                </div>
                <div class="col s12 m12 l6 right-align">
                  
                  @php
                  $cek = App\Jawaban::where('id_tugas', $tg->id)->where('id_siswa', Auth::guard('siswa')->user()->id)->count();
                  @endphp

                  @if($cek == 0)
                  Belum Mengumpulkan
                  @else
                  Sudah Mengumpulkan
                  @endif

                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
      @endforeach

    </div>
  </div>
</section>

@endforeach
@endsection