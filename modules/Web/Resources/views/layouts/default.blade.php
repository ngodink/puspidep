@extends('layouts.default')

@section('titleTemplate', config('app.name').' - Pusat Pengkajian Islam Demokrasi dan Perdamaian')

@section('bodyclass', 'min-vh-100 d-flex flex-column justify-content-between bg-light')

@section('main')
	<div>
	    @include('web::layouts.includes.navbar')
	    <div id="app" class="page-fade">
	        <main>
	            @yield('content')
	        </main>
	    </div>
    	@include('account::auth.includes.logout')
	</div>
    @include('web::layouts.includes.footer')
@endsection
