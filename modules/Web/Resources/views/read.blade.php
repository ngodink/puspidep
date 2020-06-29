@extends('web::layouts.default')

@section('title', $post->title.' - ')

@section('meta_description', Str::words(strip_tags($post->content), 15))
@section('meta_image', $post->img ? Storage::url($post->img) : null)

@section('content')
<div class="container py-4 bg-white rounded">
	<div class="row">
		<div class="col-md-8">
			<div class="card mb-4 border-0">
				@if($post->img)
					<img src="{{ Storage::url($post->img) }}" class="card-img-top rounded" alt="">
				@else
					<div class="card-body bg-light rounded" style="height: 18vh;"></div>
				@endif
				<div class="card-body p-2 p-sm-4">
					<div class="p-4 bg-white rounded shadow" style="margin-top: -18%;">
						<p>
							@forelse($post->categories as $category)
								<span class="badge badge-pill badge-dark">{{ $category->name }}</span>
							@empty
								<span class="badge badge-pill badge-secondary">Uncategorized</span>
							@endforelse
						</p>
						<h2 class="mb-2"><strong>{{ $post->title }}</strong></h2>
						<div class="text-muted mb-4">
							<i class="mdi mdi-eye"></i> <small>{{ $post->views_count }}</small>
							{{-- <i class="mdi mdi-heart"></i> <small>{{ $post->likes_count }}</small> --}}
							<i class="mdi {{ $post->commentable ? 'mdi-comment' : 'mdi-comment-remove' }}"></i> <small>{{ $post->comments_count }}</small>
							<i class="mdi mdi-calendar"></i> <small>{{ $post->created_at ? $post->created_at->ISOFormat('L') : '-' }}</small>
						</div>
						<div class="d-flex flex-row align-items-center">
							<img class="rounded-circle mr-3" src="{{ $post->author ? $post->author->profile->avatar_path : asset('img/default-avatar.svg') }}" alt="" style="width: 46px">
							<div>
								<div class="font-weight-bold">{{ $post->author->profile->name ?? 'Penulis' }}</div>
								<i>{{ $post->author->profile->bio ?? 'Tidak ada bio' }}</i>
							</div>
						</div>
						<div class="mt-4">
							{!! $post->content !!}
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<h5 class="mb-3"><strong>Postingan terkait</strong></h5>
			@include('web::includes.post-widgets-1', ['posts' => $related_posts])
			<hr class="my-4">
			<h5 class="mb-3"><strong>Postingan terbaru</strong></h5>
			@include('web::includes.post-widgets-2', ['posts' => $latest_posts])
			<hr class="my-4">
			<h5 class="mb-3"><strong>Populer</strong></h5>
			@include('web::includes.post-widgets-3', ['posts' => $popular_posts])
		</div>	
	</div>
</div>
@endsection