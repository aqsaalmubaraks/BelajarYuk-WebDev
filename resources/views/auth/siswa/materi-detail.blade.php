@extends('app-dashboard')

@section('title')
@foreach($materi as $mt)
Materi {{ $mt->judul }} | Siswa
@endforeach
@endsection

@section('content')
@foreach($materi as $mt)
<section>
  <div class="container">

    <div class="title-page-dashboard">
      <div class="row nm">
        <div class="col s12 m12 l6">
          <div class="row nm valign-wrapper">
            <div class="col m2 valign">
              <a class="btn-floating waves-effect waves-light btn-flat" href="{{ url()->previous() }}"><i class="material-icons">arrow_back</i></a>
            </div>
            <div class="col m10">
              <h5>{{ $mt->judul }}</h5>
              <h6>Created At {{ date('j F Y', strtotime($mt->created_at)) }}</h6>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>
</section>

<section>
  <div class="container">
    <div class="row">
      <div class="col s12">

        {!! $mt->materi !!}

      </div>
    </div>
  </div>
</section>

@endforeach
@endsection