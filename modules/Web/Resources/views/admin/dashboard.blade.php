@extends('web::layouts.admin')

@section('title', 'Dasbor - ')

@php($user = \Auth::user())

@section('content')
<div class="mb-4">
	<h5 class="mb-0">
		<strong><i class="mdi mdi-home-outline"></i> Dasbor</strong>
	</h5>
</div>
<div class="row">
	<div class="col-lg-8">
		<div class="jumbotron py-5">
			<h4 class="text-dark font-weight-bold">Selamat datang kembali {{ $user->profile->full_name }}!</h4>
			<p class="mb-0">di Halaman Admin Pusat Pengkajian Islam Demokrasi dan Perdamaian</p>
		</div>
		<div class="card-columns mb-4">
			@foreach($categories as $category)
				<div class="card border-0 border-left-dark">
					<div class="card-body">
						<h1><strong>{{ $category->posts_count }}</strong></h1>
						<small class="text-muted">Jumlah {{ $category->name }} <br></small>
					</div>
				</div>
			@endforeach
		</div>
		<div class="card border-0 mb-4">
			<div class="card-header bg-gray-200">
				<i class="mdi mdi-post"></i> Postingan terbaru
			</div>
			@include('web::includes.post-widgets-6', ['post' => $recent_posts])
		</div>
	</div>
	<div class="col-lg-4">
		<div class="card border-0 mb-4">
			<div class="card-header bg-gray-200">
				<i class="mdi mdi-post"></i> Postingan paling banyak dilihat
			</div>
			@include('web::includes.post-widgets-6', ['post' => $most_viewed_posts])
		</div>
		<div class="card border-0 mb-4">
			<div class="card-header bg-gray-200">
				<i class="mdi mdi-account-circle-outline"></i> Akun Anda
			</div>
			<div class="list-group list-group-flush">
				<div class="list-group-item">
					Nama <br>
					<strong>{{ $user->profile->name }}</strong>
				</div>
				<div class="list-group-item">
					Username <br>
					<strong>{{ $user->username }}</strong>
				</div>
				<a class="list-group-item list-group-item-action text-success" href="{{ route('account::index', ['next' => url()->current()]) }}">Selengkapnya &raquo;</a>
			</div>
		</div>
	</div>
</div>
@endsection