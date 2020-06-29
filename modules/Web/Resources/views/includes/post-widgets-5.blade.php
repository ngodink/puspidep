<div class="mb-3">
	@forelse($posts as $post)
		<a class="text-dark" href="{{ route('web::read', ['category' => $post->category()->slug, 'slug' => $post->slug]) }}">
			<div class="d-flex flex-row align-items-center justify-content-between mb-2">
				<div class="flex-grow-1">
					<strong>{{ Str::limit($post->title, 50) }}</strong> <br>
					<div class="text-muted">
						<i class="mdi mdi-eye"></i> <small>{{ $post->views_count }}</small>
						{{-- <i class="mdi mdi-heart"></i> <small>{{ $post->likes_count }}</small> --}}
						<i class="mdi {{ $post->commentable ? 'mdi-comment' : 'mdi-comment-remove' }}"></i> <small>{{ $post->comments_count }}</small>
						<i class="mdi mdi-calendar"></i> <small>{{ $post->created_at ? $post->created_at->ISOFormat('L') : '-' }}</small>
					</div>
				</div>
			</div>
		</a>
	@empty
		Tidak ada postingan
	@endforelse
</div>