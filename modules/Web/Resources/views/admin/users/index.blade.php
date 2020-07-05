@extends('web::layouts.admin')

@section('title', 'Pengguna - ')

@php($url = url()->current())

@section('content')
<div class="mb-4">
	<h5 class="mb-0">
		<strong><i class="mdi mdi-account-group-outline"></i> Pengguna</strong>
	</h5>
</div>
<div class="mb-4">
	<a class="btn btn-success" href="{{ route('web::admin.users.create', ['next' => $url]) }}"><i class="mdi mdi-plus-circle-outline"></i> Buat pengguna baru</a>
</div>
<div class="row">
	<div class="col-lg-8">
		<div class="card border-0 mb-4">
			<div class="card-header bg-gray-200">
				<i class="mdi mdi-account-group"></i> Daftar pengguna
			</div>
			<div class="card-body">
				<form class="form-block" action="{{ route('web::admin.users.index') }}" method="GET">
					<div class="input-group">
						<input type="hidden" name="role" value="{{ request('role') }}">
						<input type="hidden" name="trashed" value="{{ request('trashed') }}">
						<input class="form-control" type="search" name="search" placeholder="Cari nama disini..." value="{{ request('search') }}">
						<div class="input-group-append">
							<a class="btn btn-light border" href="{{ route('web::admin.users.index') }}"><i class="mdi mdi-refresh"></i></a>
							<button class="btn btn-dark"><i class="mdi mdi-magnify"></i></button>
						</div>
					</div>
				</form>
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-hover mb-0">
					<thead class="thead-dark">
						<tr>
							<th>No</th>
							<th></th>
							<th>Nama</th>
							<th>Peran</th>
							<th>Bergabung</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@forelse($users as $user)
							<tr>
								<td class="align-middle">{{ $users->firstItem() + $loop->iteration - 1 }}</td>
								<td class="align-middle" style="width: 40px;">
									<img class="rounded-circle mr-3" src="{{ $user->author ? $user->author->profile->avatar_path : asset('img/default-avatar.svg') }}" alt="" style="width: 36px">
								</td>
								<td>
									<strong>{{ $user->profile->name }}</strong> <br>
									{{ $user->username }}
								</td>
								<td class="align-middle">
									<div>
										@forelse($user->roles->take(3) as $role)
											<span class="badge badge-pill badge-dark">{{ $role->display_name }}</span>
										@empty
											&mdash;
										@endforelse
									</div>
								</td>
								<td class="align-middle">
									<small>{{ $user->created_at }}</small>
								</td>
								<td class="align-middle">
									@if(auth()->user()->isnot($user) && $user->id != 1001)
										@if($user->trashed())
											<form class="d-inline form-confirm form-block" action="{{ route('web::admin.users.restore', ['user' => $user->id]) }}" method="POST"> @csrf @method('PUT')
												<button class="btn btn-success btn-sm rounded-pill mr-2">Pulihkan</button>
											</form>
											@can('root')
												<form class="d-inline form-confirm form-block" action="{{ route('web::admin.users.kill', ['user' => $user->id]) }}" method="POST"> @csrf @method('DELETE')
													<button class="btn btn-danger btn-sm rounded-pill mr-2">Hapus permanen</button>
												</form>
											@endcan
										@else
											<a class="btn btn-warning btn-sm rounded-pill text-nowrap mr-2" href="{{ route('web::admin.users.edit', ['user' => $user->id, 'next' => url()->current()]) }}"><i class="mdi mdi-pencil-outline"></i> Edit</a>
											<form class="d-inline form-confirm form-block" action="{{ route('web::admin.users.destroy', ['user' => $user->id]) }}" method="POST"> @csrf @method('DELETE')
												<button class="btn btn-danger btn-sm rounded-pill"><i class="mdi mdi-trash-can"></i></button>
											</form>
										@endif
									@endif
								</td>
							</tr>
						@empty
							<tr>
								<td class="text-center" colspan="6">Tidak ada data</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
			<div class="card-body">
				{{ $users->appends(request()->all())->links() }}
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="card border-0 mb-4">
			<div class="card-header bg-gray-200">
				<i class="mdi mdi-filter-outline"></i> Filter
			</div>
			<div class="card-body">
				<form class="form-block" action="{{ route('web::admin.users.index') }}" method="get">
					<div class="form-group">
						<select type="text" class="form-control" name="role">
							<option value="">Semua peran</option>
							@foreach($roles as $role)
								<option value="{{ $role->id }}" @if(request('role') == $role->id) selected @endif>{{ $role->display_name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group mb-0">
						<button type="submit" class="btn btn-dark">Tetapkan</button>
					</div>
				</form>
			</div>
		</div>
		<div class="card border-0 mb-4">
			<div class="card-header bg-gray-200">
				<i class="mdi mdi-cogs"></i> Lanjutan
			</div>
			<div class="list-group list-group-flush">
				<a class="list-group-item list-group-item-action text-danger" href="{{ route('web::admin.users.index', ['role' => request('role'), 'trashed' => request('trashed') ? 0 : 1 ]) }}">
					<i class="mdi mdi-trash-can-outline"></i>Tampilkan pengguna yang {{ request('trashed') ? 'tidak' : '' }} dihapus
				</a>
			</div>
		</div>
	</div>
</div>
@endsection