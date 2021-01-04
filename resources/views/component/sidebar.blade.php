{{-- SIDEBAR ADMIN --}}
@if(request()->is('admin','admin/*'))
<ul id="sidenav-admin" class="sidenav sidenav-fixed sidenav-dash-t">
  <li><div class="logo-nav"><h5>Admin</h5></div></li>
  <li><a class="subheader">Dashboard</a></li>
  <li class="
  {{ (request()->routeIs(

    'admin.dashboard'

    )) ? 'active' : '' }}
    ">
    <a href="{{route('admin.dashboard')}}"><i class="material-icons">dashboard</i>Dashboard</a>
  </li>
  <li class="
  {{ (request()->routeIs(

    'admin.guru'

    )) ? 'active' : '' }}
    ">
    <a href="{{route('admin.guru')}}"><i class="material-icons">support_agent</i>Guru</a>
  </li>
  <li class="
  {{ (request()->routeIs(

    'admin.siswa'

    )) ? 'active' : '' }}
    ">
    <a href="{{route('admin.siswa')}}"><i class="material-icons">face</i>Siswa</a>
  </li>
  <li class="
  {{ (request()->routeIs(

    'admin.kelas',
    'admin.kelas.materi',
    'admin.kelas.tugas',
    'admin.kelas.siswa',
    'admin.kelas.materi_komponen',
    'admin.kelas.tugas_detail',
    'admin.kelas.rekap'

    )) ? 'active' : '' }}
    ">
    <a href="{{route('admin.kelas')}}"><i class="material-icons">local_library</i>Kelas</a>
  </li>

</ul>
@endif

{{-- SIDEBAR GURU --}}
@if(request()->is('guru','guru/*'))
<ul id="sidenav-guru" class="sidenav">
  <li>
    <div class="user-view">
      <div class="background">
        <img src="{{asset('asset/img/asset-login.jpg')}}">
      </div>
      <a href="{{route('guru.setting')}}"><img class="circle" src="{{asset('asset/img/asset-regisguru.png')}}"></a>
      <a href="{{route('guru.setting')}}"><span class="white-text name">{{ Auth::guard('guru')->user()->nama }}</span></a>
      <a href="{{route('guru.setting')}}"><span class="white-text email">NIP {{ Auth::guard('guru')->user()->nip }}</span></a>
    </div>
  </li>
  <li class="
  {{ (request()->routeIs(

    'guru.dashboard'

    )) ? 'active' : '' }}
    ">
    <a href="{{route('guru.dashboard')}}"><i class="material-icons">dashboard</i>Dashboard</a>
  </li> 

  <li><a class="subheader">Kelas</a></li>

{{--   @php
  $kelass = App\Kelas::where('id_guru', Auth::guard('guru')->user()->id)->get();
  @endphp

  @foreach($kelass as $kl)
  <li class="
  {{ (request()->routeIs(

    'guru.materi'

    )) ? 'active' : '' }}
    ">
    <a href="{{route('guru.materi', $kl->id)}}"><i class="material-icons">cast_for_education</i>{{ $kl->kelas }}</a>
  </li> 
  @endforeach --}}

  <li><a class="subheader">Menu</a></li>

  <li class="
  {{ (request()->routeIs(

    'guru.setting'

    )) ? 'active' : '' }}
    ">
    <a href="{{route('guru.setting')}}"><i class="material-icons">settings</i>Setting</a>
  </li> 
</ul>
@endif

{{-- SIDEBAR SISWA --}}
@if(request()->is('siswa','siswa/*'))
<ul id="sidenav-siswa" class="sidenav">
  <li>
    <div class="user-view">
      <div class="background">
        <img src="{{asset('asset/img/asset-login.jpg')}}">
      </div>
      <a href="{{route('siswa.setting')}}"><img class="circle" src="{{asset('asset/img/asset-regissiswa.png')}}"></a>
      <a href="{{route('siswa.setting')}}"><span class="white-text name">{{ Auth::guard('siswa')->user()->nama }}</span></a>
      <a href="{{route('siswa.setting')}}"><span class="white-text email">NIS {{ Auth::guard('siswa')->user()->nis }}</span></a>
    </div>
  </li>    
  <li class="
  {{ (request()->routeIs(

    'siswa.dashboard'

    )) ? 'active' : '' }}
    ">
    <a href="{{route('siswa.dashboard')}}"><i class="material-icons">dashboard</i>Dashboard</a>
  </li>

  <li><a class="subheader">Kelas</a></li>

{{--   <li class="
  {{ (request()->routeIs(

    'siswa.materi',
    'siswa.materi_detail',
    'siswa.tugas',
    'siswa.tugas_detail',
    'siswa.setting_kelas',
    'siswa.rekap'

    )) ? 'active' : '' }}
    ">
    <a href="{{route('siswa.materi')}}"><i class="material-icons">cast_for_education</i>Nama Kelas</a>
  </li>  --}}

  <li><a class="subheader">Menu</a></li>

  <li class="
  {{ (request()->routeIs(

    'siswa.setting'

    )) ? 'active' : '' }}
    ">
    <a href="{{route('siswa.setting')}}"><i class="material-icons">settings</i>Setting</a>
  </li>
</ul>
@endif