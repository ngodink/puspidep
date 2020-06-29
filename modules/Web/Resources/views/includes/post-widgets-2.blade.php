<div class="list-group list-group-flush">
	@forelse($posts->load('categories') as $post)
		<a class="list-group-item list-group-item-action px-0 @if($loop->last) border-bottom-0 @endif @if($loop->first) border-top-0 @endif" style="border-top-style: dotted;" href="{{ route('web::read', ['category' => $post->category()->slug, 'slug' => $post->slug]) }}">
			<span class="d-flex flex-row justify-content-between align-items-center">
				<i class="mdi mdi-chevron-right-circle-outline mr-2"></i>
				<div class="flex-grow-1">
					<div class="small">
						@foreach($post->categories as $category)
							<strong class="text-success">{{ $category->name }}</strong>
						@endforeach
					</div>
					{{ $post->title }}
				</div>
			</span>
		</a>
	@empty
		Tidak ada postingan
	@endforelse
</div>