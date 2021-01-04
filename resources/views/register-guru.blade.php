@extends('app-home')

@section('title')
Register Guru | Belajar Yuk!
@endsection

@section('content')

<section class="bg-image-full pb-5" style="background-image: url('{{asset('asset/img/asset-bglogin.png')}}');">
	<div class="container w30">

		<div class="row pbt-1">
			<div class="col s6 left-align">
				<div class="mbt-1">
					<a href="{{route('login')}}" class="waves-effect btn-flat"><i class="material-icons left">arrow_back</i>Back To Login</a>
				</div>
			</div>
			<div class="col s6 right-align">
				<div class="title-page mbt-1">
					<h5>Register Guru</h5>
				</div>
			</div>
		</div>

		<div class="card-panel outlined nm">
			<form action="{{ route('register.guru.post') }}" method="POST">
				@csrf
				<div class="row">
					<div class="input-field col s12">
						<input placeholder="Nama" id="nama" type="text" class="validate" name="nama">
						<label for="nama">Nama</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input placeholder="NIP" id="nip" type="text" class="validate" name="nip">
						<label for="nip">NIP</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input placeholder="Username" id="username" type="text" class="validate" name="username">
						<label for="username">Username</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input placeholder="Password" id="password" type="password" class="validate" name="password">
						<label for="password">Password</label>
					</div>
				</div>
				<div class="row nm">
					<div class="input-field col s12 right-align">
						<button type="submit" class="waves-effect waves-light btn btn-large primary-dark outlined">Submit</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>

@endsection