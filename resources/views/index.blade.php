@extends('app-home')

@section('title')
Belajar Yuk!
@endsection

@section('content')

<div class="navbar-fixed">
  <nav class="navbar-home">
    <div class="container">
      <div class="nav-wrapper">
        <a href="{{route('home')}}" class="brand-logo">Logo</a>
        <a href="#" data-target="mobile-demo" class="sidenav-trigger primary-dark-text"><i class="material-icons">menu</i></a>
        <ul class="right hide-on-med-and-down">
          <li><a class="link-nav" href="{{route('home')}}/#about">About</a></li>
          <li><a class="link-nav" href="{{route('home')}}/#fitur">Fitur</a></li>
          <li><a class="link-nav" href="{{route('home')}}/#team">Team</a></li>
          <li><a href="{{route('login')}}" class="waves-effect waves-light btn outlined primary-dark">Login<i class="material-icons right">login</i></a></li>
        </ul>
      </div>
    </div>
  </nav>
</div>

<ul class="sidenav" id="mobile-demo">
  <li><a href="{{route('home')}}/#about">About</a></li>
  <li><a href="{{route('home')}}/#fitur">Fitur</a></li>
  <li><a href="{{route('home')}}/#team">Team</a></li>
  <li><a href="{{route('login')}}" class="waves-effect waves-light btn outlined primary-dark">Login<i class="material-icons right">login</i></a></li>
</ul>

<section class="con-header">
  <div class="container">
    <div class="row animated fadeInDown">
      <div class="col s12 m12 l6">
        <h2 class="primary-dark-text">Belajar <b class="primary-text">Yuk!</b></h2>
        <h4 class="grey-text text-darken-1">Platform Pembelajaran Online <br> Terbaik di Dunia</h4>
        <br>
        <a class="waves-effect waves-light btn btn-large primary-dark outlined modal-trigger" href="#modal-regis">Getting Strarted!</a>
      </div>
      <div class="col s12 m12 l6">
        <img class="responsive-img" src="{{asset('asset/img/asset-header.png')}}">
      </div>
    </div>
  </div>
</section>

<section id="about" class="con-page">
  <div class="container">
    <div class="title-page animated fadeInUp faster">
      <h4>About</h4>
    </div>

    <div class="row animated fadeInUp faster">
      <div class="col s12 m12 l6">
        <img src="{{asset('asset/img/asset-about.jpg')}}" class="responsive-img" alt="gambar-about">
      </div>
      <div class="col s12 m12 l6">
        <h4 class="primary-dark-text"><b>Belajar Yuk!</b></h4>
        <p>
          <b>BalajarYuk!</b> merupakan perusahaan teknologi pendidikan dengan misi memberikan pendidikan terbaik hingga ke daerah terpencil. Berdiri pertama kali pada tahun 2010 di London - Inggris, layanan <b>BalajarYuk!</b> saat ini telah dapat dinikmati di beberapa negara seperti Jepang, Filipina, dan Indonesia. <br><br>Sejak tahun 2020, <b>BalajarYuk!</b> telah menjadi bagian dari ekosistem pendidikan Indonesia dengan turut menyediakan, memperbaiki, dan mendistribusikan pendidikan berkualitas untuk guru dan siswa.
        </p>
      </div>
    </div>
  </div>
</section>

<section id="fitur" class="grey lighten-4 con-page">
  <div class="container">
    <div class="title-page animated fadeInUp faster">
      <h4>Fitur</h4>
    </div>

    <div class="row animated fadeInUp faster">
      <div class="col s6 m6 l4 center">
        <img src="{{asset('asset/img/asset-tugas.png')}}" class="responsive-img" alt="gambar-fitur-1" style="width: 50%">
        <h5 class="primary-dark-text"><b>Tugas Online </b></h5>
        <p>Guru dapat memberi tugas pada siswa <br> dan siswa dapat mengerjakan secara online.</p>
      </div>
      <div class="col s6 m6 l4 center">
        <img src="{{asset('asset/img/asset-materi.png')}}" class="responsive-img" alt="gambar-fitur-2" style="width: 50%">
        <h5 class="primary-dark-text"><b>Materi Online </b></h5>
        <p>Siswa dapat mengakses dan mempelajari <br> materi secara online yang diberikan oleh guru.</p>
      </div>
      <div class="col s6 m6 l4 center">
        <img src="{{asset('asset/img/asset-rekap.png')}}" class="responsive-img" alt="gambar-fitur-3" style="width: 50%">
        <h5 class="primary-dark-text"><b>Rekap Data</b></h5>
        <p>Siswa maupun guru dapat merekap <br> data tugas, nilai dan materi secara online.</p>
      </div>
    </div>
  </div>
</section>

<section id="team" class="con-page">
  <div class="container">
    <div class="title-page animated fadeInUp faster">
      <h4>Our Team</h4>
    </div>

    <div class="row animated fadeInUp faster center">
      <div class="col s12 m12 l4">
        <div class="card outlined">
          <img src="{{asset('asset/img/team/asset-team-aqsa.jpg')}}" alt="gambar-team-1" class="responsive-img" />
          <div class="card-content">
           <h5>Aqsa</h5>
         </div>
       </div>
     </div>
     <div class="col s12 m12 l4">
      <div class="card outlined">
        <img src="{{asset('asset/img/team/asset-team-ryan.jpg')}}" alt="gambar-team-1" class="responsive-img" />
        <div class="card-content">
         <h5>Ryan</h5>
       </div>
     </div>
   </div>
   <div class="col s12 m12 l4">
    <div class="card outlined">
      <img src="{{asset('asset/img/team/asset-team-rama.jpg')}}" alt="gambar-team-1" class="responsive-img" />
      <div class="card-content">
       <h5>Rama</h5>
     </div>
   </div>
 </div>

 <div class="col s12 m12 l2"></div>
 <div class="col s12 m12 l4">
  <div class="card outlined">
    <img src="{{asset('asset/img/team/asset-team-anisa.jpg')}}" alt="gambar-team-1" class="responsive-img" />
    <div class="card-content">
      <h5>Annisa</h5>
    </div>
  </div>
</div>
<div class="col s12 m12 l4">
  <div class="card outlined">
    <img src="{{asset('asset/img/team/asset-team-farah.jpg')}}" alt="gambar-team-1" class="responsive-img" />
    <div class="card-content">
     <h5>Sherina</h5>
   </div>
 </div>
</div>
<div class="col s12 m12 l2"></div>
</div>
</div>
</section>

<footer class="page-footer white">
  <div class="container con-page">
    <div class="row nm">
      <div class="col s12 center">
        <div class="primary-dark-text">© 2020 Copyright BelajarYuk!</div>
      </div>
    </div>
  </div>
</footer>

@endsection