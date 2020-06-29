@extends('layouts.default')

@section('titleTemplate', config('account.name'))

@section('bodyclass', 'bg-light')

@section('main')
    @include('account::layouts.includes.navbar')
	@if (session('success'))
	<div class="alert alert-success bg-success text-white rounded-0 border-0 px-0 mb-0">
		<div class="container">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
			{!! session('success') !!}
		</div>
	</div>
	@endif
	@if (session('danger'))
	<div class="alert alert-danger bg-danger text-white rounded-0 border-0 px-0 mb-0">
		<div class="container">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
			{!! session('danger') !!}
		</div>
	</div>
	@endif
	<div id="app" class="py-3 py-sm-4 page-fade">
		<main>
			<div class="container">
				@yield('content')
			</div>
		</main>
	</div>
    @include('account::auth.includes.logout')
@endsection
