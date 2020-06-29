@extends('layouts.default')

@push('style')
<style>
	.bg-auth {
		background: url('{{ asset('img/auth.jpg') }}') no-repeat center;
		background-size: cover;
	}
</style>
@endpush

@section('titleTemplate', config('account.name'))

@section('bodyclass', 'bg-light')

@section('main')
	<div class="container-fluid p-0">
		<div class="row no-gutters min-vh-100">
			<div class="col-lg-7 col-md-6 d-none d-md-block">
				<div class="bg-auth vh-100"></div>
			</div>
			<div class="col-lg-5 col-md-6 col-sm-8 offset-sm-2 offset-md-0">
				<main class="card-body p-4 h-100 d-flex align-items-center flex-column">
					<div class="mb-auto w-100">
			    		<p class="mb-5">
	    					<a href="{{ config('app.url') }}" tabindex="-1" class="btn btn-link p-0 text-dark text-decoration-none">
	    						<img src="{{ asset('img/logo/rounded-bw-32.png') }}" alt="" class="mr-2"> <strong>{{ config('app.name') }}</strong>
	    					</a>
	    				</p>
						@if (session('success'))
						    <div class="alert alert-success bg-success text-white">
					            <button type="button" class="close" data-dismiss="alert"> <span>&times;</span> </button>
					            {!! session('success') !!}
						    </div>
						@endif
						@if (session('danger'))
						    <div class="alert alert-danger bg-danger text-white">
					            <button type="button" class="close" data-dismiss="alert"> <span>&times;</span> </button>
					            {!! session('danger') !!}
						    </div>
						@endif
	    				@yield('content')
					</div>
					<div class="w-100">
						<div class="text-muted border-top pt-3 mt-3">
							<div class="d-flex flex-row justify-content-between">
								<small>Copyright &copy;2020</small>
								<small><a href="{{ env('APP_URL') }}">{{ env('APP_DOMAIN') }}</a></small>
							</div>
						</div>
					</div>
			    </main>
			</div>
		</div>
	</div>
	@auth
    	@include('account::auth.includes.logout')
	@endauth
@endsection
