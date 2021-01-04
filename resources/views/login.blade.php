@extends('app-home')

@section('title')
Login | Belajar Yuk!
@endsection

@section('content')

<section class="bg-image-full" style="background-image: url('{{asset('asset/img/asset-about.jpg')}}'); height: 720px">
	<div class="row nm">
		<div class="col s12 m12 l6">
			<div style="height: 300px"></div>
		</div>
		<div class="col s12 m12 l6 white">
			<div class="container" style="height: 720px; padding: 10rem 0">

				<div class="mgb-5">
					<a href="{{route('home')}}" class="waves-effect btn-flat"><i class="material-icons left">arrow_back</i>Back To Home</a>
				</div>

				<form action="/login" method="POST">
					@csrf
					<div class="row">
						<div class="input-field col s12">
							<input placeholder="Username" id="first_name" type="text" class="validate" name="username">
							<label for="first_name">Username</label>
						</div>
						<div class="input-field col s12">
							<input placeholder="Password" id="first_name" type="password" class="validate" name="password">
							<label for="first_name">Password</label>
						</div>
						<div class="input-field col s12 right-align">
							<button type="submit" class="waves-effect waves-light btn btn-large primary-dark outlined">Login</button>
							<a class="waves-effect waves-light btn btn-large outlined modal-trigger" href="#modal-regis">Register</a>
						</div>
					</div>
				</form>
				
			</div>
		</div>
	</div>
</section>

@endsection