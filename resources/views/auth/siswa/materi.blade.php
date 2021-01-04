@extends('app-dashboard')

@section('title')
@foreach($kelas as $kl)
Materi {{ $kl->kelas }} | Siswa
@endforeach
@endsection

@section('content')
@foreach($kelas as $kl)

<section>
  <div class="container">
    <div class="title-page-dashboard">
      <div class="row nm">
        <div class="col s12 m12 l6">
          <h5>Materi</h5>
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

      @foreach($materi as $mt)
      <div class="col s12">
        <a href="{{route('siswa.materi_detail', $mt->id)}}">
          <div class="card outlined">
            <div class="card-title row nm">
              <div class="col s11">
                <div class="title">
                  <h6>{{ $mt->judul }}</h6>
                </div>
              </div>
              <div class="col s1">
              </div>
            </div>

            <div class="card-content ptb-1">
              <div class="row nm">
                <div class="col s12 m12 l6 left-align">
                  Created At {{ date('j F Y', strtotime($mt->created_at)) }}
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