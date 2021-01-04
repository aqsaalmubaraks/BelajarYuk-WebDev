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

	@if(request()->is('admin','admin/*'))
	<style type="text/css">
		header, main, footer {
			padding-left: 300px;
		}

		@media only screen and (max-width : 992px) {
			header, main, footer {
				padding-left: 0;
			}
		}
	</style>
	@endif

	@yield('css-plus')

</head>
<body>

	@include('component.navbar')
	@include('component.sidebar')

	<main class="main-dash">
		@yield('content')
	</main>

	@include('sweetalert::alert')

	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>

	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>

	<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>

	<script type="text/javascript" src="{{asset('asset/js/materialize.js')}}"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.tabs').tabs();
		});
		
		$(document).ready(function(){
			$('.modal').modal();
		});

		$(window).scroll(function() {     
			var scroll = $(window).scrollTop();
			if (scroll > 0) {
				$("nav").addClass("nav-active");
				
			} else {
				$("nav").removeClass("nav-active");
			}
		});

		$(document).ready(function(){
			$('#sidenav-admin').sidenav({ edge: 'left' });
			$('#sidenav-guru').sidenav({ edge: 'left' });
			$('#sidenav-siswa').sidenav({ edge: 'left' });
		});

		$(document).ready(function(){
			$('.collapsible').collapsible();
		});

		$('.dropdown-trigger').dropdown();

		$(document).ready(function(){
			var elem = document.querySelector('.collapsible.expandable');
			var instance = M.Collapsible.init(elem, {
				accordion: false
			});
		});
	</script>

	@yield('js-plus')

</body>
</html>