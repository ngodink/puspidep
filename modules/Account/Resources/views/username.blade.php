@extends('account::layouts.default')

@section('title', 'Ubah username - ')

@section('content')
<div class="row justify-content-center">
	<div class="col-sm-10 col-md-8 col-lg-6">
		<h2>
			<a class="text-decoration-none small" href="{{ request('next', route('account::index')) }}"><i class="mdi mdi-arrow-left-circle-outline"></i></a>
			Ubah username
		</h2>
		<hr>
		<p class="text-secondary">Username ini digunakan untuk login ke {{ config('app.name') }}</p>
		<div class="card mb-4">
			<div class="card-body">
				<form class="form-block" action="{{ route('account::username', ['next' => request('next')]) }}" method="POST"> @csrf @method('PUT')
					<div class="form-group required">
						<label>Username</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text">@</span>
							</div>
							<input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username', $user->username) }}" required>
						</div>
						<small class="form-text text-muted">Nama unik pengguna (bukan nama lengkap), digunakan untuk login, terdiri dari huruf kecil, titik, dan angka, tanpa spasi.</small>
						@error('username')
							<small class="text-danger"> {{ $message }} </small>
						@enderror
					</div>
					<div class="form-group mb-0">
						<button class="btn btn-success" type="submit">Simpan</button>
						<a class="btn btn-secondary" href="{{ request('next', route('account::index')) }}">Kembali</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection