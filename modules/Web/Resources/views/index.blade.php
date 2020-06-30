@extends('web::layouts.default')

@section('content')
<div class="container py-4 bg-white rounded">
	<div class="row ">
		<div class="col-md-8">
			@include('web::includes.post-widgets-4', ['posts' => $latest_posts])
			<div id="category-lists" class="card-columns p-0">
				@foreach($categories as $category)
					@php($posts = $category->load(['posts' => function($q) { return $q->take(6); }])->posts)
					<div class="card border-0 mb-4">
						<div class="card-body p-0">
							<p class="border-bottom-success">
								<a class="bg-success py-1 px-2 text-white rounded-top" href="{{ route('web::category', ['category' => $category->slug]) }}"><strong>{{ $category->name }}</strong></a>
							</p>
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

@push('style')
	<style>
		@media (max-width:575.98px) {
			#category-lists {
				column-count: 1 !important;
			}
		}
		#category-lists {
			column-count: 2;
		}
	</style>
@endpush