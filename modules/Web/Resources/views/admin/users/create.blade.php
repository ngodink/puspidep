@extends('web::layouts.admin')

@section('title', 'Buat pengguna baru - ')

@php($url = url()->current())

@section('content')
<div class="row d-flex justify-content-center">
	<div class="col-lg-6 col-md-8 col-sm-10">
		<div class="mb-4">
			<h5 class="mb-0">
				<a href="{{ request('next', route('web::admin.users.index')) }}"><i class="mdi mdi-arrow-left-circle-outline"></i></a>
				<strong>Buat pengguna baru</strong>
			</h5>
		</div>
		<div class="card border-0 mb-4">
			<div class="card-body">
				<form class="form-block" action="{{ route('web::admin.users.store') }}" method="POST"> @csrf
					<div class="form-group required">
						<label>Nama lengkap</label>
						<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required autofocus>
						@error('name')
							<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>
					<div class="form-group required">
						<label>Username</label>
						<input class="form-control @error('username') is-invalid @enderror" type="text" name="username" value="{{ old('username') }}" required>
						@error('username')
							<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>
					<div class="form-group">
						<label>Bio</label>
						<textarea class="form-control @error('bio') is-invalid @enderror" type="text" name="bio">{!! old('bio') !!}</textarea>
						@error('bio')
							<span class="invalid-feedback">{{ $message }}</span>
						@enderror
						<small class="text-muted">Opsional</small>
					</div>
					<div class="form-group required">
						<label>Peran</label>
						<div class="rounded border @error('roles') border-danger @enderror p-2">
							@foreach($roles as $role)
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" name="roles[]" id="role{{ $role->id }}" value="{{ $role->id }}" @if(in_array($role->id, old('roles', []))) checked @endif>
									<label class="custom-control-label" for="role{{ $role->id }}">{{ $role->display_name }}</label>
								</div>
							@endforeach
						</div>
						@error('roles')
							<small class="text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group mb-0">
						<button type="submit" class="btn btn-success"><i class="mdi mdi-check"></i> Simpan</button>
						<a class="btn btn-secondary" href="{{ request('next', route('web::admin.users.index')) }}"><i class="mdi mdi-arrow-left"></i> Kembali</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>	
@endsection