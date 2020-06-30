<div class="row no-gutters">
	@forelse($posts as $post)
		@if($post->img)
			<a class="col-6 p-1 text-dark mb-2" href="{{ route('web::read', ['category' => $post->category()->slug, 'slug' => $post->slug]) }}">
				<img class="img-fluid rounded" src="{{ Storage::url($post->img) }}" alt="">
				{{ $post->title }}
			</a>
		@endif
	@empty
		Tidak ada postingan
	@endforelse
</div>