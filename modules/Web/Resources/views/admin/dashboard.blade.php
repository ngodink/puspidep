@extends('web::layouts.admin')

@section('title', 'Dasbor - ')

@php($user = \Auth::user())

@section('content')
<div class="mb-4">
	<h5 class="mb-0">
		<strong><i class="mdi mdi-home-outline"></i> Dasbor</strong>
	</h5>
</div>
<div class="row">
	<div class="col-lg-8">
		<div class="jumbotron py-5">
			<h4 class="text-dark font-weight-bold">Selamat datang kembali {{ $user->profile->full_name }}!</h4>
			<p class="mb-0">di Halaman Admin Pusat Pengkajian Islam Demokrasi dan Perdamaian</p>
		</div>
		<div class="card-columns mb-4">
			@foreach($categories as $category)
				<div class="card border-0 border-left-dark">
					<div class="card-body">
						<h1><strong>{{ $category->posts_count }}</strong></h1>
						<small class="text-muted">Jumlah {{ $category->name }} <br></small>
					</div>
				</div>
			@endforeach
		</div>
		<div class="card border-0 mb-4">
			<div class="card-header bg-gray-200">
				<i class="mdi mdi-post"></i> Postingan terbaru
			</div>
			<div class="list-group list-group-flush">
				@forelse($recent_posts as $post)
					<a class="list-group-item list-group-item-action" href="{{ route('web::read', ['category' => $post->category()->slug, 'slug' => $post->slug]) }}" target="_blank">
						<div class="d-flex flex-row align-items-center justify-content-between">
							<div class="rounded mr-2" style="background: url({{ asset('storage/'.$post->img) }}) center center no-repeat; background-size: cover; min-width: 60px; height: 60px;"></div>
							<div class="flex-grow-1">
								<strong>{{ Str::limit($post->title, 50) }}</strong> <br>
								<i class="mdi mdi-eye"></i> <small>{{ $post->views_count }}</small>
								{{-- <i class="mdi mdi-heart"></i> <small>{{ $post->likes_count }}</small> --}}
								<i class="mdi {{ $post->commentable ? 'mdi-comment' : 'mdi-comment-remove' }}"></i> <small>{{ $post->comments_count }}</small>
								<i class="mdi mdi-calendar"></i> <small>{{ $post->created_at ? $post->created_at->ISOFormat('L') : '-' }}</small>
							</div>
							<i class="mdi mdi-open-in-new"></i>
						</div>
					</a>
				@empty
					<div class="list-group-item">
						 Tidak ada postingan
					</div>
				@endforelse
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		<div class="card border-0 mb-4">
			<div class="card-header bg-gray-200">
				<i class="mdi mdi-post"></i> Postingan paling banyak dilihat
			</div>
			<div class="list-group list-group-flush">
				@forelse($most_viewed_posts as $post)
					<a class="list-group-item list-group-item-action" href="{{ route('web::read', ['category' => $post->category()->slug, 'slug' => $post->slug]) }}" target="_blank">
						<div class="d-flex flex-row align-items-center justify-content-between">
							<div class="rounded mr-2" style="background: url({{ asset('storage/'.$post->img) }}) center center no-repeat; background-size: cover; min-width: 60px; height: 60px;"></div>
							<div class="flex-grow-1">
								<strong>{{ Str::limit($post->title, 50) }}</strong> <br>
								<i class="mdi mdi-eye"></i> <small>{{ $post->views_count }}</small>
								{{-- <i class="mdi mdi-heart"></i> <small>{{ $post->likes_count }}</small> --}}
								<i class="mdi {{ $post->commentable ? 'mdi-comment' : 'mdi-comment-remove' }}"></i> <small>{{ $post->comments_count }}</small>
								<i class="mdi mdi-calendar"></i> <small>{{ $post->created_at ? $post->created_at->ISOFormat('L') : '-' }}</small>
							</div>
							<i class="mdi mdi-open-in-new"></i>
						</div>
					</a>
				@empty
					<div class="list-group-item">
						 Tidak ada postingan
					</div>
				@endforelse
			</div>
		</div>
		<div class="card border-0 mb-4">
			<div class="card-header bg-gray-200">
				<i class="mdi mdi-account-circle-outline"></i> Akun Anda
			</div>
			<div class="list-group list-group-flush">
				<div class="list-group-item">
					Nama <br>
					<strong>{{ $user->profile->name }}</strong>
				</div>
				<div class="list-group-item">
					Username <br>
					<strong>{{ $user->username }}</strong>
				</div>
				<a class="list-group-item list-group-item-action text-success" href="{{ route('account::index', ['next' => url()->current()]) }}">Selengkapnya &raquo;</a>
			</div>
		</div>
	</div>
</div>
@endsection