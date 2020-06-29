@extends('account::layouts.default')

@section('title', 'Ubah sandi - ')

@section('content')
<div class="row justify-content-center">
	<div class="col-sm-10 col-md-8 col-lg-6">
		<h2>
			<a class="text-decoration-none small" href="{{ request('next', route('account::index')) }}"><i class="mdi mdi-arrow-left-circle-outline"></i></a>
			Ubah sandi
		</h2>
		<hr>
		<p class="text-secondary">Pilih sandi yang kuat dan jangan gunakan lagi untuk akun lain</p>
		<div class="card mb-4">
			<div class="card-body">
				<form class="form-block" action="{{ route('account::password', ['next' => request('next')]) }}" method="POST"> @csrf @method('PUT')
					<div class="form-group required">
						<label>Sandi lama</label>
						<input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" required autofocus>
						@error('old_password')
							<small class="text-danger"> {{ $message }} </small>
						@enderror
					</div>
					<div class="form-group required">
						<label>Sandi baru</label>
						<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
						<small class="form-text text-muted">Gunakan sedikitnya 4 karakter. Jangan gunakan sandi dari situs lain atau sesuatu yang mudah ditebak seperti tanggal lahir Anda.</small>
						@error('password')
							<small class="text-danger"> {{ $message }} </small>
						@enderror
					</div>
					<div class="form-group required">
						<label>Konfirmasi sandi baru</label>
						<input type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required>
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