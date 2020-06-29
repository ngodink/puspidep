@extends('account::layouts.auth')

@section('title', 'Email terverifikasi - ')

@section('content')
	<h2>Email terverifikasi</h2>
	<p>Terimakasih telah memverifikasi alamat e-mail Anda {{ $email->address }}</p>
	<button class="btn btn-success" style="border: none;" onclick="window.close()">Tutup halaman ini</button>
@endsection