@extends('web::layouts.admin')

@section('title', 'Kategori - ')

@php($url = url()->current())

@section('content')
<div class="mb-4">
	<h5 class="mb-0">
		<strong><i class="mdi mdi-newspaper"></i> Kategori</strong>
	</h5>
</div>
<div class="row">
	<div class="col-lg-8">
		<div class="card border-0 mb-4">
			<div class="card-header bg-gray-200">
				<i class="mdi mdi-view-list-outline"></i> Daftar kategori
			</div>
			<div class="card-body">
				<form class="form-block" action="{{ route('web::admin.categories.index') }}" method="GET">
					<div class="input-group">
						<input class="form-control" type="search" name="search" placeholder="Cari kategori disini..." value="{{ request('search') }}">
						<div class="input-group-append">
							<a class="btn btn-light border" href="{{ route('web::admin.categories.index') }}"><i class="mdi mdi-refresh"></i></a>
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
							<th>Nama</th>
							<th>Slug</th>
							<th nowrap>Jumlah post</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@forelse($categories as $category)
							<tr>
								<td class="align-middle">{{ $categories->firstItem() + $loop->iteration - 1 }}</td>
								<td>
									<strong>{{ $category->name }}</strong><br>
									<small>{{ $category->description }}</small>
								</td>
								<td>{{ $category->slug }}</td>
								<td class="text-center">{{ $category->posts_count }}</td>
								<td class="align-middle">
									<a class="btn btn-warning btn-sm rounded-pill text-nowrap mr-2" href="{{ route('web::admin.categories.edit', ['category' => $category->id, 'next' => url()->current()]) }}"><i class="mdi mdi-pencil-outline"></i> Edit</a>
									@can('administrator')
										<form class="d-inline form-confirm form-block" action="{{ route('web::admin.categories.destroy', ['category' => $category->id]) }}" method="POST"> @csrf @method('DELETE')
											<button class="btn btn-danger btn-sm rounded-pill"><i class="mdi mdi-trash-can"></i></button>
										</form>
									@endcan
								</td>
							</tr>
						@empty
							<tr>
								<td class="text-center" colspan="4">Tidak ada data</td>
							</tr>
						@endforelse
					</tbody>
				</table>
			</div>
			<div class="card-body">
				{{ $categories->appends(request()->all())->links() }}
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="card border-0 mb-4">
			<div class="card-header bg-gray-200">
				<i class="mdi mdi-plus-circle-outline"></i> Buat kategori
			</div>
			<div class="card-body">
				<form class="form-block" action="{{ route('web::admin.categories.store', ['next' => request("next", url()->current())]) }}" method="POST"> @csrf
					<div class="form-group required">
						<label>Nama kategori</label>
						<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required>
						@error('name')
							<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>
					<div class="form-group">
						<label>Deskripsi</label>
						<textarea class="form-control @error('description') is-invalid @enderror" type="text" name="description">{!! old('description') !!}</textarea>
						@error('description')
							<span class="invalid-feedback">{{ $message }}</span>
						@enderror
						<small class="text-muted">Opsional</small>
					</div>
					<div class="form-group mb-0">
						<button type="submit" class="btn btn-success"><i class="mdi mdi-check"></i> Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection