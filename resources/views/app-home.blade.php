<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>

	<title>@yield('title')</title>

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{asset('asset/css/materialize.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('asset/css/app.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('asset/css/animation.css')}}">

	@yield('css-plus')

</head>
<body>

	@yield('content')

	<div id="modal-regis" class="modal">
		<div class="modal-content">
			<div class="title-page nm">
				<h4>Register</h4>
			</div>
			<br>
			<div class="row">
				<div class="col s12 m12 l6">
					<a href="{{route('register.siswa')}}">
						<div class="card-panel outlined center">
							<img src="{{asset('asset/img/asset-regissiswa.png')}}" alt="img-siswa" class="responsive-img" style="height: 250px">
							<h5 class="primary-dark-text">Siswa</h5>
						</div>
					</a>
				</div>
				<div class="col s12 m12 l6">
					<a href="{{route('register.guru')}}">
						<div class="card-panel outlined center">
							<img src="{{asset('asset/img/asset-regisguru.png')}}" alt="img-guru" class="responsive-img" style="height: 250px">
							<h5 class="primary-dark-text">Guru</h5>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>

	@include('sweetalert::alert')

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript" src="{{asset('asset/js/materialize.js')}}"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.tabs').tabs();
		});
		$(document).ready(function(){
			$('.modal').modal();
		});
		$(document).ready(function(){
			$('.sidenav').sidenav();
		});

		$(window).scroll(function() {     
			var scroll = $(window).scrollTop();
			if (scroll > 0) {
				$("nav").addClass("nav-active");
				
			} else {
				$("nav").removeClass("nav-active");
			}
		});
	</script>

	@yield('js-plus')

</body>
</html>