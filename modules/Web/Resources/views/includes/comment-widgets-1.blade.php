<div class="list-group list-group-flush">
	@forelse($comments as $comment)
		<a class="list-group-item list-group-item-action" href="{{ route('web::admin.posts.show', ['post' => $comment->post_id]) }}">
			<strong>{{ $comment->commentator->profile->full_name }}</strong>
				@if(!$comment->published_at)
					<span class="badge badge-pill badge-danger float-right"><i class="mdi mdi-comment-alert"></i></span>
				@endif
			<br>
			<small>{{ Str::words($comment->content, 10) }}</small> <br>
			<small class="text-muted">{{ $comment->created_at }}</small>
		</a>
	@empty
		<div class="list-group-item"> Tidak ada commentingan </div>
	@endforelse
</div>