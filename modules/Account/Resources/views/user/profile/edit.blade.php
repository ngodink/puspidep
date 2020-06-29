@extends('account::layouts.default')

@section('title', 'Ubah profil - ')

@section('content')
<div class="row justify-content-center">
	<div class="col-sm-10 col-md-9 col-lg-8">
		<h2>
			<a class="text-decoration-none small" href="{{ request('next', route('account::index')) }}"><i class="mdi mdi-arrow-left-circle-outline"></i></a>
			Ubah profil
		</h2>
		<hr>
		<p class="text-secondary">Perubahan informasi dibawah akan diterapkan di {{ config('app.name') }} Anda</p>
		<div class="card mb-4">
			<div class="card-body">
				<form class="form-block" action="{{ route('account::user.profile', ['next' => request('next')]) }}" method="POST"> @csrf @method('PUT')
					@include('account::user.profile.includes.form', ['user' => $user, 'back' => true])
				</form>
			</div>
		</div>
	</div>
</div>
@endsection