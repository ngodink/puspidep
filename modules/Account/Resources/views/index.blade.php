@extends('account::layouts.default')

@section('title', $user->profile->name.' - ')

@section('content')
	<div class="text-center mb-4">
		<h3 class="mb-1">Info pribadi</h3>
		<p class="mb-0 text-muted">Info dasar, seperti nama dan foto, yang Anda gunakan di layanan kami</p>
	</div>
	@if($user->email->address && !$user->email->verified_at && $user->id == auth()->id())
		<div class="alert alert-danger">
			E-mail Anda belum terverifikasi, silahkan <a class="alert-link content-block" href="{{ route('account::user.email.reverify', ['uid' => encrypt($user->email->id), 'next' => ($next ?? route('account::index'))]) }}">Klik disini!</a> untuk memverifikasi e-mail Anda!
		</div>
	@endif
	<div class="row">
		<div class="col-sm-5 col-md-4">
			<div class="card mb-4">
				<div class="dropdown position-absolute" style="top: .3em; right: 0;">
					<a class="btn btn-link text-secondary" href="javascript:;" id="dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical mdi-24px"></i></a>
					<div class="dropdown-menu dropdown-menu-right border-0 shadow">
						@if($user->phone->whatsapp)
							<a class="dropdown-item" href="https://wa.me/{{ $user->phone->number }}" target="_blank"><i class="mdi mdi-whatsapp"></i> Hubungi via Whatsapp</a>
						@endif
						@if($user->email->verified_at)
							<a class="dropdown-item" href="mailto:{{ $user->email->address }}"><i class="mdi mdi-email-outline"></i> Kirim e-mail</a>
						@endif
						@if(auth()->id() == $user->id)
							<a class="dropdown-item" href="{{ route('account::auth.logout') }}" onclick="event.preventDefault(); $('#logout-form').submit();"><i class="mdi mdi-logout"></i> Keluar</a>
						@endif
					</div>
				</div>
				<div class="card-body text-center">
					<div class="py-4">
						<img class="rounded-circle" src="{{ asset('img/default-avatar.svg') }}" alt="" width="128">
					</div>
					<h5 class="mb-1"><strong>{{ $user->profile->name }}</strong></h5>
					<p>{{ $user->username }}</p>
					<h4 class="mb-0">
						@if($user->phone->whatsapp)
							<a class="text-success px-1" href="https://wa.me/{{ $user->phone->number }}" target="_blank"><i class="mdi mdi-whatsapp"></i></a>
						@endif
						@if($user->email->verified_at)
							<a class="text-danger px-1" href="mailto:{{ $user->email->address }}"><i class="mdi mdi-email-outline"></i></a>
						@endif
					</h4>
				</div>
			</div>
			<div class="card mb-4">
				<div class="card-body">
					<h4 class="mb-1">Info akun</h4>
					<p class="mb-2 text-muted">Informasi tentang akun Anda, hanya Anda yang dapat melihat ini</p>
				</div>
				<div class="list-group list-group-flush">
					@foreach([
						'Bergabung pada' => $user->created_at->diffForHumans(),
					] as $k => $v)
						<div class="list-group-item border-0">
							{{ $k }} <br>
							<span class="{{ $v ? 'font-weight-bold' : 'text-muted' }}">
								{{ $v ?? 'Belum diisi' }}
							</span>
						</div>
					@endforeach
					<div class="list-group-item border-0 text-muted">
						<i class="mdi mdi-account-circle"></i> User ID : {{ $user->id }}
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-7 col-md-8">
			<div class="card mb-4">
				<div class="dropdown position-absolute" style="top: .3em; right: 0;">
					<a class="btn btn-link text-secondary" href="javascript:;" id="dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical mdi-24px"></i></a>
					<div class="dropdown-menu dropdown-menu-right border-0 shadow">
						<a class="dropdown-item disabled" href="javascript:;"><i class="mdi mdi-image-edit-outline"></i> Ubah foto</a>
						<a class="dropdown-item" href="{{ route('account::user.profile') }}"><i class="mdi mdi-pencil-outline"></i> Ubah profil</a>
					</div>
				</div>
				<div class="card-body">
					<h4 class="mb-1">Profil</h4>
					<p class="mb-2 text-muted">Beberapa info mungkin terlihat oleh orang lain</p>
				</div>
				<div class="list-group list-group-flush">
					@foreach([
						'Nama lengkap' => [$user->profile->full_name, route('account::user.profile')],
						'Tempat lahir' => [$user->profile->pob, route('account::user.profile')],
						'Tanggal lahir' => [$user->profile->dob_name, route('account::user.profile')],
						'Jenis kelamin' => [$user->profile->sex_name, route('account::user.profile')],
					] as $k => $v)
						<a class="list-group-item list-group-item-action border-0" href="{{ $v[1] }}">
							<div class="row">
								<div class="col-10">
									<div class="row">
										<div class="col-md-4">
											<small>{{ $k }}</small>
										</div>
										<div class="col-md-8">
											<span class="{{ $v[0] ? 'font-weight-bold text-gray-800' : 'text-muted' }}">
												{{ $v[0] ?? 'Belum diisi' }}
											</span>
										</div>
									</div>
								</div>
								<div class="col-2 text-right align-self-center">
									<i class="mdi mdi-chevron-right"></i>
								</div>
							</div>
						</a>
					@endforeach
				</div>
			</div>
			<div class="card mb-4">
				<div class="card-body">
					<h4 class="mb-1">Info kontak</h4>
				</div>
				<div class="list-group list-group-flush">
					@foreach([
						'Alamat e-mail' => [$user->email->address, ($user->email->verified_at ? ' <span class="badge badge-pill badge-success font-weight-normal">Terverifikasi</span>' : ' <span class="badge badge-pill badge-danger font-weight-normal">Belum verifikasi</span>'), route('account::user.email')],
						'Nomor HP' => [$user->phone->number, ($user->phone->whatsapp ? ' <i class="mdi mdi-whatsapp text-success"></i>' : null), route('account::user.phone')],
					] as $k => $v)
						<a class="list-group-item list-group-item-action border-0" href="{{ $v[2] }}">
							<div class="row">
								<div class="col-10">
									<div class="row">
										<div class="col-md-4">
											<small>{{ $k }}</small>
										</div>
										<div class="col-md-8">
											<span class="{{ $v[0] ? 'font-weight-bold text-gray-800' : 'text-muted' }}">
												{!! $v[0] ? $v[0].$v[1] : 'Belum diisi' !!}
											</span>
										</div>
									</div>
								</div>
								<div class="col-2 text-right align-self-center">
									<i class="mdi mdi-chevron-right"></i>
								</div>
							</div>
						</a>
					@endforeach
				</div>
			</div>
			<div class="card mb-4">
				<div class="card-body">
					<i class="mdi mdi-settings-outline"></i> Menu lainnya 
				</div>
				<div class="list-group list-group-flush">
					@can('updateUsername', User::class)
						<a class="list-group-item list-group-item-action" href="{{ route('account::username') }}"><i class="mdi mdi-pencil-outline"></i> Ubah username</a>
					@endcan
					@can('update', $user)
						<a class="list-group-item list-group-item-action" href="{{ route('account::password') }}"><i class="mdi mdi-pencil-outline"></i> Ubah sandi</a>
					@endcan
					<a class="list-group-item list-group-item-action" href="{{ route('account::auth.logout') }}" onclick="event.preventDefault(); $('#logout-form').submit();"><i class="mdi mdi-logout"></i> Keluar </a>
				</div>
			</div>
		</div>
	</div>
	<p class="text-center text-secondary mt-4 mb-0">Hanya Anda yang dapat mengakses halaman ini, kami berkomitmen untuk menjaga privasi Anda.</p>
@endsection