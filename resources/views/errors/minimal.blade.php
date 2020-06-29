@extends('layouts.default')

@section('bodyclass', 'd-flex min-vh-100 align-items-center text-center bg-white')

@section('main')
    <div class="container-fluid">
        <p><img src="{{ asset('img/undraw/empty.png') }}" alt="" class="w-100" style="max-width: 400px;"></p>
        <div class="display-4 font-weight-bold mb-2">
            @yield('code')
        </div>
        <p class="text-muted">@yield('message')</p>
        <a class="btn btn-sm btn-dark rounded-pill px-3 mr-2" href="{{ url()->previous() }}">Kembali</a>
        <a class="btn btn-sm btn-outline-dark rounded-pill px-3" href="{{ config('app.url') }}">Halaman utama</a>
    </div>
@endsection
