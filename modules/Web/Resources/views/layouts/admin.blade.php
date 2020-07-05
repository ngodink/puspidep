@extends('layouts.default')

@section('titleTemplate', config('app.name').' - Pusat Pengkajian Islam Demokrasi dan Perdamaian')

@section('bodyclass', 'min-vh-100 d-flex flex-column justify-content-between bg-light')

@section('main')
    
    <div id="wrapper">
        @include('web::layouts.includes.admin.sidebar')
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <button id="sidebarToggleTop" class="btn btn-light text-dark d-md-none rounded-circle m-2 position-fixed" style="right: 0; z-index: 99;">
                    <i class="mdi mdi-menu mdi-24px"></i>
                </button>
                <div class="container-fluid pt-4">
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {!! session('success') !!}
                            <button type="button" class="close" data-dismiss="alert"> <span>&times;</span> </button>
                        </div>
                    @endif
                    @if(session()->has('danger'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {!! session('danger') !!}
                            <button type="button" class="close" data-dismiss="alert"> <span>&times;</span> </button>
                        </div>
                    @endif
                    @yield('content')
                </div>
            </div>
            @include('web::layouts.includes.admin.footer')
        </div>
    </div>

    @auth
        @include('account::auth.includes.logout')
    @endauth

@endsection