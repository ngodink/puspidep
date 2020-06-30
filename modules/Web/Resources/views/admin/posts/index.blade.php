@extends('web::layouts.admin')

@section('title', 'Postingan - ')

@php($url = url()->current())

@section('content')
<div class="mb-4">
	<h5 class="mb-0">
		<strong><i class="mdi mdi-newspaper"></i> Postingan</strong>
	</h5>
</div>
<div class="mb-4">
	<a class="btn btn-success" href="{{ route('web::admin.posts.create', ['next' => $url]) }}"><i class="mdi mdi-plus-circle-outline"></i> Buat postingan baru</a>
</div>
<div class="row">
	<div class="col-lg-8">
		<div class="card border-0 mb-4">
			<div class="card-header bg-gray-200">
				<i class="mdi mdi-view-list-outline"></i> Daftar postingan
			</div>
			<div class="card-body">
				<form class="form-block" action="{{ route('web::admin.posts.index') }}" method="GET">
					<div class="input-group">
						<input type="hidden" name="category" value="{{ request('category') }}">
						<input type="hidden" name="trashed" value="{{ request('trashed') }}">
						<input class="form-control" type="search" name="search" placeholder="Cari judul disini..." value="{{ request('search') }}">
						<div class="input-group-append">
							<a class="btn btn-light border" href="{{ route('web::admin.posts.index') }}"><i class="mdi mdi-refresh"></i></a>
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
							<th>Judul</th>
							<th>Kategori</th>
							<th>Dipublikasi</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@forelse($posts as $post)
							<tr>
								<td class="align-middle">{{ $posts->firstItem() + $loop->iteration - 1 }}</td>
								<td style="min-width: 300px;">
									<strong>{{ $post->title }}</strong>
									@if($post->unpublished_comments_count)
										<a href="{{ route('web::admin.posts.show', ['post' => $post->id, 'next' => url()->current()]) }}">
											<span class="badge badge-pill badge-danger"><i class="mdi mdi-comment-alert"></i> {{ $post->unpublished_comments_count }}</span>
										</a>
									@endif
									<br>
									@if($post->trashed())
										<form class="d-inline form-confirm form-block" action="{{ route('web::admin.posts.restore', ['post' => $post->id]) }}" method="POST"> @csrf @method('PUT')
											<button class="btn btn-link align-baseline text-success p-0 mr-2">Pulihkan</button>
										</form>
										<form class="d-inline form-confirm form-block" action="{{ route('web::admin.posts.kill', ['post' => $post->id]) }}" method="POST"> @csrf @method('DELETE')
											<button class="btn btn-link align-baseline text-danger p-0 mr-2">Hapus permanen</button>
										</form>
									@else
										<a class="mr-2" href="{{ route('web::admin.posts.edit', ['post' => $post->id, 'next' => url()->current()]) }}">Edit</a>
										<form class="d-inline form-confirm form-block" action="{{ route('web::admin.posts.destroy', ['post' => $post->id]) }}" method="POST"> @csrf @method('DELETE')
											<button class="btn btn-link align-baseline text-danger p-0 mr-2">Buang</button>
										</form>
										<a href="{{ route('web::read', ['category' => $post->category()->slug, 'slug' => $post->slug, 'next' => $url]) }}" target="_blank">Lihat</a>
									@endif
								</td>
								<td class="align-middle" style="max-width: 200px;">
									<div>
										@forelse($post->categories->take(3) as $category)
											<span class="badge badge-pill badge-dark">{{ $category->name }}</span>
										@empty
											<span class="badge badge-pill badge-secondary">Uncategorized</span>
										@endforelse
									</div>
								</td>
								<td class="align-middle">
									<small>{{ $post->published_at ? $post->published_at->ISOFormat('L') : '-' }}</small><br>
									<i class="mdi mdi-eye"></i> <small>{{ $post->views_count }}</small>
									{{-- <i class="mdi mdi-heart"></i> <small>{{ $post->likes_count }}</small> --}}
									<i class="mdi {{ $post->commentable ? 'mdi-comment' : 'mdi-comment-remove' }}"></i> <small>{{ $post->comments_count }}</small>
								</td>
								<td class="align-middle">
									<a class="btn btn-primary btn-sm rounded-pill text-nowrap" href="{{ route('web::admin.posts.show', ['post' => $post->id, 'next' => url()->current()]) }}"><i class="mdi mdi-eye-outline"></i> Detail</a>
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
				{{ $posts->appends(request()->all())->links() }}
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="card border-0 mb-4">
			<div class="card-header bg-gray-200">
				<i class="mdi mdi-filter-outline"></i> Filter
			</div>
			<div class="card-body">
				<form class="form-block" action="{{ route('web::admin.posts.index') }}" method="get">
					<div class="form-group">
						<select type="text" class="form-control" name="category">
							<option value="">Semua kategori</option>
							@foreach($categories as $category)
								<option value="{{ $category->id }}" @if(request('category') == $category->id) selected @endif>{{ $category->name }}</option>
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
				<i class="mdi mdi-comment-multiple"></i> Komentar terakhir
			</div>
			@include('web::includes.comment-widgets-1', ['comments' => $latest_comments])
		</div>
		<div class="card border-0 mb-4">
			<div class="card-header bg-gray-200">
				<i class="mdi mdi-cogs"></i> Lanjutan
			</div>
			<div class="list-group list-group-flush">
				<a class="list-group-item list-group-item-action text-danger" href="{{ route('web::admin.posts.index', ['category' => request('category'), 'trashed' => request('trashed') ? 0 : 1 ]) }}">
					<i class="mdi mdi-trash-can-outline"></i>Tampilkan postingan yang {{ request('trashed') ? 'tidak' : '' }} dihapus
				</a>
			</div>
		</div>
	</div>
</div>
@endsection