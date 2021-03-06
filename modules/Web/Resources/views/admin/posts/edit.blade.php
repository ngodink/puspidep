@extends('web::layouts.admin')

@section('title', 'Edit postingan - ')

@php($url = url()->current())

@section('content')
<div class="mb-4">
	<h5 class="mb-0">
		<a href="{{ request('next', route('web::admin.posts.index')) }}"><i class="mdi mdi-arrow-left-circle-outline"></i></a>
		<strong>Edit postingan</strong>
	</h5>
</div>
<form class="form-block" action="{{ route('web::admin.posts.update', ['post' => $post->id]) }}" method="POST" enctype="multipart/form-data" id="edit_post"> @csrf @method('PUT')
	<div class="row">
		<div class="col-lg-4">
			<div class="card border-0 mb-4">
				<div class="card-body">
					<div class="form-group">
						<label>Kategori</label>
						<div class="rounded border @error('categories') border-danger @enderror p-2">
							@foreach($categories as $category)
								<div class="custom-control custom-checkbox">
									<input type="checkbox" class="custom-control-input" name="categories[]" id="category{{ $category->id }}" value="{{ $category->id }}" @if(in_array($category->id, old('categories', $post->categories->pluck('id')->toArray() ?? []))) checked @endif>
									<label class="custom-control-label" for="category{{ $category->id }}">{{ $category->name }}</label>
								</div>
							@endforeach
						</div>
						@error('categories')
							<small class="text-danger">{{ $message }}</small>
						@enderror
					</div>
					<div class="form-group">
						<label>Penulis</label>
						<select type="text" class="form-control @error('author_id') is-invalid @enderror" name="author_id">
							<option value="">-- Pilih --</option>
							@foreach($authors as $author)
								<option value="{{ $author->id }}" @if(old('author_id', $post->author_id)) selected @endif>{{ $author->profile->name }} ({{ $author->username }})</option>
							@endforeach
						</select>
						@error('author_id')
							<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>
					<div class="form-group">
						<label>Waktu publish</label>
						<input type="date" class="form-control @error('published_at') is-invalid @enderror" name="published_at" value="{{ $post->published_at ? $post->published_at->format('Y-m-d') : date('Y-m-d') }}">
						@error('published_at')
							<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>
					<label>Foto cover</label>
					<div class="border @error('file') border-danger @enderror rounded text-center mb-3">
						<img id="upload-preview" class="img-fluid" src="{{ $post->img ? Storage::url($post->img) : asset('img/no-image.png') }}" alt="" style="max-height: 224px;">
					</div>
					<div class="form-group">
						<div class="input-group">
							<div class="custom-file">
								<input type="file" name="file" class="custom-file-input" id="upload-input" accept="image/*">
								<label class="custom-file-label" for="upload-input">Pilih cover ...</label>
							</div>
						</div>
						@error('file')
							<small class="text-danger"> {{ $message }} </small>
						@enderror
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-8 order-lg-first">
			<div class="card border-0 mb-4">
				<div class="card-body">
					<div class="form-group">
						<input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Judul postingan" value="{{ old('title', $post->title) }}" autofocus required>
						@error('title')
							<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>
					<div class="form-group">
						<textarea name="content" class="summernote">
							{{ old('content', $post->content) }}
						</textarea>
						@error('content')
							<span class="invalid-feedback">{{ $message }}</span>
						@enderror
					</div>
					<div class="form-group">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="commentable" name="commentable" value="1" @if(old('commentable', $post->commentable == 1 ? 1 : 0)) checked @endif>
							<label class="custom-control-label" for="commentable">Centang untuk mengaktifkan fitur komentar</label>
						</div>
					</div>
					<div class="form-group mb-0">
						<button type="submit" class="btn btn-success"><i class="mdi mdi-check"></i> Publish</button>
						<a class="btn btn-secondary" href="{{ request('next', route('web::admin.posts.index')) }}"><i class="mdi mdi-arrow-left"></i> Kembali</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
@endsection

@push('style')
	<link rel="stylesheet" href="{{ asset('css/summernote.min.css') }}">
@endpush

@push('script')
<script src="{{ asset('js/summernote.min.js') }}"></script>
<script>
	$(() => {
		$('.summernote').summernote({
			placeholder: 'Tulis isi postingan disini ...',
			height: 250
		});
		function readURL(input) {
			if (input.files && input.files[0]) {
				$('[for="upload-input"]').html(input.files[0].name)
				var reader = new FileReader();
				reader.onload = function(e) {
					$('#upload-preview').attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}

		$("#upload-input").change(function(e) {
			readURL(this);
		});
	})
</script>
@endpush