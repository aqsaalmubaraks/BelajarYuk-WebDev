<header>
  <nav class="nav-dash">
    <div class="nav-wrapper">
      <div class="row">
        <div class="col s12">
          <ul class="left">
            <li>
              @if(request()->is('admin','admin/*'))
              <a href="#" data-target="sidenav-admin" class="sidenav-trigger hide-on-medium-and-up primary-dark-text">
                <i class="material-icons">menu</i>
              </a>
              @endif
              @if(request()->is('guru','guru/*'))
              <a href="#" data-target="sidenav-guru" class="sidenav-trigger show-on-large show-on-medium show-on-small primary-dark-text">
                <i class="material-icons">menu</i>
              </a>
              @endif
              @if(request()->is('siswa','siswa/*'))
              <a href="#" data-target="sidenav-siswa" class="sidenav-trigger show-on-large show-on-medium show-on-small primary-dark-text">
                <i class="material-icons">menu</i>
              </a>
              @endif
            </li>
          </ul>

          {{-- GURU --}}
          @if(request()->is('guru/kelas/*'))

          @foreach($kelas as $kl)
          <ul class="nav-center nav-menu-large hide-on-med-and-down">
            <li class="
            {{ (request()->routeIs(

              'guru.materi',
              'guru.materi_detail'

              )) ? 'active' : '' }}
              ">
              <a href="{{route('guru.materi', $kl->id)}}">Materi</a>
              <div class="nav-actives"></div>
            </li>
            <li class="
            {{ (request()->routeIs(

              'guru.tugas',
              'guru.tugas_detail'

              )) ? 'active' : '' }}
              ">
              <a href="{{route('guru.tugas', $kl->id)}}">Tugas</a>
              <div class="nav-actives"></div>
            </li>
            <li class="
            {{ (request()->routeIs(

              'guru.rekap'

              )) ? 'active' : '' }}
              ">
              <a href="{{route('guru.rekap', $kl->id)}}">Rekap</a>
              <div class="nav-actives"></div>
            </li>
            <li class="
            {{ (request()->routeIs(

              'guru.setting_kelas'

              )) ? 'active' : '' }}
              ">
              <a href="{{route('guru.setting_kelas', $kl->id)}}">Setting</a>
              <div class="nav-actives"></div>
            </li>
          </ul>
          @endforeach

          @endif

          {{-- SISWA --}}
          @if(request()->is('siswa/kelas/*'))
          @foreach($kelas as $kl)
          <ul class="nav-center nav-menu-large hide-on-med-and-down">
            <li class="
            {{ (request()->routeIs(

              'siswa.materi',
              'siswa.materi_detail'

              )) ? 'active' : '' }}
              ">
              <a href="{{route('siswa.materi', $kl->id)}}">Materi</a>
              <div class="nav-actives"></div>
            </li>
            <li class="
            {{ (request()->routeIs(

              'siswa.tugas',
              'siswa.tugas_detail'

              )) ? 'active' : '' }}
              ">
              <a href="{{route('siswa.tugas', $kl->id)}}">Tugas</a>
              <div class="nav-actives"></div>
            </li>
            <li class="
            {{ (request()->routeIs(

              'siswa.rekap'

              )) ? 'active' : '' }}
              ">
              <a href="{{route('siswa.rekap', $kl->id)}}">Rekap</a>
              <div class="nav-actives"></div>
            </li>
            <li class="
            {{ (request()->routeIs(

              'siswa.setting_kelas'

              )) ? 'active' : '' }}
              ">
              <a href="{{route('siswa.setting_kelas', $kl->id)}}">Setting</a>
              <div class="nav-actives"></div>
            </li>
          </ul>
          @endforeach
          @endif

          @if(request()->is('guru','guru/*'))
          <ul class="right">
            <li><a class="waves-effect waves-light btn outlined primary dropdown-trigger" href='#' data-target='dropdown-akun'>{{ Auth::guard('guru')->user()->username }}<i class="material-icons left">account_circle</i></a></li>
          </ul>

          <ul id='dropdown-akun' class='dropdown-content'>
            <li><a href="{{route('guru.setting')}}">Setting</a></li>
            <li><a href="/logout">Logout</a></li>
          </ul>
          @endif

          @if(request()->is('siswa','siswa/*'))
          <ul class="right">
            <li><a class="waves-effect waves-light btn outlined primary dropdown-trigger" href='#' data-target='dropdown-akun'>{{ Auth::guard('siswa')->user()->username }}<i class="material-icons left">account_circle</i></a></li>
          </ul>

          <ul id='dropdown-akun' class='dropdown-content'>
            <li><a href="{{route('siswa.setting')}}">Setting</a></li>
            <li><a href="/logout">Logout</a></li>
          </ul>
          @endif

          @if(request()->is('admin','admin/*'))
          <ul class="right">
            <li><a class="waves-effect waves-light btn outlined primary dropdown-trigger" href='#' data-target='dropdown-akun'>{{ Auth::guard('admin')->user()->username }}<i class="material-icons left">account_circle</i></a></li>
          </ul>

          <ul id='dropdown-akun' class='dropdown-content'>
            <li><a href="{{route('admin.setting')}}">Setting</a></li>
            <li><a href="/logout">Logout</a></li>
          </ul>
          @endif

        </div>
      </div>
    </div>
  </nav>
</header>