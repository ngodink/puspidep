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