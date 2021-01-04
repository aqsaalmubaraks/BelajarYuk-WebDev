@extends('app-dashboard')

@section('title')
@foreach($kelas as $kl)
Setting Kelas | Siswa
@endforeach
@endsection

@section('content')
@foreach($kelas as $kl)

<section class="mgb-3">
  <div class="container">

    <div class="title-page-dashboard mb-0">
      <div class="row nm">
        <div class="col s12 m12 l6">
          <h5>Setting Kelas</h5>
          <h6>{{ $kl->kelas }} | By {{ App\Guru::where('id', $kl->id_guru)->value('nama') }}</h6>
        </div>

        <div class="col s12 m12 l6 right-align">
        </div>
      </div>
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
                {{ $kl->kelas }}
              </div>
            </div>
          </td>
          <td>  
            
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
            
          </td>
        </tr>
      </tbody>
    </table>
    <br>
    <br>
    <div class="right-align">
      <a class="waves-effect waves-light btn outlined danger modal-trigger" href="#modal-keluar-kelas">Keluar Kelas</a>
    </div>
  </div>
</section>

<div id="modal-keluar-kelas" class="modal small">
  <form action="" method="">
    @csrf

    <div class="modal-content">
      <div class="title-page nm">
        <h4>Keluar Kelas</h4>
      </div>
      <br>

      <h6>Anda akan keluar dari kelas ...</h6>

    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-red btn-flat">Cancel</a>
      <button type="submit" class="waves-effect waves-green btn outlined danger">Ya Keluar</button>
    </div>
  </form>
</div>

{{-- MODAL --}}

@endforeach
@endsection