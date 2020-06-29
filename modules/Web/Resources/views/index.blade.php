@extends('web::layouts.default')

@section('content')
<div class="container py-4 bg-white rounded">
	<div class="row">
		<div class="col-md-8">
			@include('web::includes.post-widgets-4', ['posts' => $latest_posts])
			<div class="card-columns" style="column-count: 2;">
				@foreach($categories as $category)
					@php($posts = $category->load(['posts' => function($q) { return $q->take(6); }])->posts)
					<div class="card bg-light border-0">
						<div class="card-body">
							<p><a class="text-muted" href="{{ route('web::category', ['category' => $category->slug]) }}"><strong>{{ $category->name }}</strong></a></p>
							@include('web::includes.post-widgets-3', ['posts' => $posts])
							@if($posts->count())
								<a href="{{ route('web::category', ['category' => $category->slug]) }}"><small>Lebih banyak &raquo;</small></a>
							@endif
						</div>
					</div>
				@endforeach
			</div>
		</div>
		<div class="col-md-4">
			<h5 class="mb-3"><strong>Populer</strong></h5>
			@include('web::includes.post-widgets-1', ['posts' => $popular_posts])
			<hr class="my-4">
			<h5 class="mb-3"><strong>Postingan terbaru</strong></h5>
			@include('web::includes.post-widgets-2', ['posts' => $latest_posts])
		</div>
	</div>
</div>
@endsection