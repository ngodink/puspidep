@extends('web::layouts.default')

@section('title', $category->name.' - ')

@section('content')
<div class="container py-4 bg-white rounded">

	<div class="row">
		<div class="col-md-8">
			<h5 class="mb-5"><strong>{{ $category->name }} terbaru</strong></h5>
			@forelse($posts as $post)
				<a class="text-dark" href="{{ route('web::read', ['category' => $category->slug, 'slug' => $post->slug]) }}">
					<div class="d-sm-flex flex-row filtered align-items-center">
						<div class="mr-sm-4">
							<div class="filtered-img mb-3 mb-sm-0 rounded" style="background: url({{ asset('storage/'.$post->img) }}) center center no-repeat; background-size: cover; min-width: 200px; height: 200px;"></div>
						</div>
						<div class="my-3">
							<div class="d-flex flex-row align-items-center">
								<img class="rounded-circle mr-3" src="{{ $post->author ? $post->author->profile->avatar_path : asset('img/default-avatar.svg') }}" alt="" style="width: 46px">
								<div>
									<div class="font-weight-bold">{{ $post->author->profile->name ?? 'Penulis' }}</div>
									<div class="text-muted small">{{ $post->published_at->ISOFormat('LL') }}</div>
								</div>
							</div>
							<h5 class="mt-3"><strong>{{ $post->title }}</strong></h5>
							<div class="text-muted mb-2 mb-lg-4">{{ \Str::words(strip_tags($post->content), 12) }}</div>
							<a href="{{ route('web::read', ['category' => $category->slug, 'slug' => $post->slug]) }}">Selengkapnya &raquo;</a>
						</div>
					</div>
				</a>
				@if($loop->last)
					<br><br>
					{{ $posts->links() }}
				@else
					<hr class="my-4 my-sm-5">
				@endif
			@empty
				Tidak ada {{ strtolower($category->name) }}
			@endforelse
		</div>
		<div class="col-md-4 mt-5 mt-sm-0">
			<h5 class="mb-5"><strong>Latest Blog</strong></h5>
			<div class="bg-light mb-4 rounded" style="height: 250px;"></div>
			<hr class="my-4 my-sm-5">
			<h5 class="mb-5"><strong>Latest Portofolio</strong></h5>
			<div class="bg-light mb-4 rounded" style="height: 400px;"></div>
		</div>
	</div>

</div>
@endsection