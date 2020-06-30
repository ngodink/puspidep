<div id="post-carousel" class="carousel slide carousel-fade mb-5" data-ride="carousel">
	<ol class="carousel-indicators">
		@foreach($posts as $post)
			<li data-target="#post-carousel" data-slide-to="{{ $loop->index }}" @if($loop->first) class="active" @endif></li>
		@endforeach
	</ol>
	<div class="carousel-inner rounded">
		@foreach($posts as $post)
			<div class="carousel-item @if($loop->first) active @endif">
				<div class="black-overlay" style="@if($post->img) background: url({{ Storage::url($post->img) }}) center center no-repeat; background-size: cover; @else background-color: #3a3b45; @endif height: 400px;"></div>
				<div class="carousel-caption mb-2">
					<h5><strong>{{ $post->title }}</strong></h5>
					<div class="mb-2">
						@foreach($post->categories as $category)
							<strong class="badge badge-pill badge-success">{{ $category->name }}</strong>
						@endforeach
					</div>
					<p>
						<i class="mdi mdi-eye"></i> <small>{{ $post->views_count }}</small>
						{{-- <i class="mdi mdi-heart"></i> <small>{{ $post->likes_count }}</small> --}}
						<i class="mdi {{ $post->commentable ? 'mdi-comment' : 'mdi-comment-remove' }}"></i> <small>{{ $post->comments_count }}</small>
						<i class="mdi mdi-calendar"></i> <small>{{ $post->created_at ? $post->created_at->ISOFormat('L') : '-' }}</small>
					</p>
					<a class="btn btn-light rounded-pill btn-sm px-3" href="{{ route('web::read', ['category' => $post->category()->slug, 'slug' => $post->slug]) }}">Selengkapnya &raquo;</a>
				</div>
			</div>
		@endforeach
	</div>
	<a class="carousel-control-prev" href="#post-carousel" role="button" data-slide="prev">
		<span class="mdi mdi-chevron-left-circle-outline h2"></span>
	</a>
	<a class="carousel-control-next" href="#post-carousel" role="button" data-slide="next">
		<span class="mdi mdi-chevron-right-circle-outline h2"></span>
	</a>
</div>
