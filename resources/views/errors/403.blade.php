@extends('errors::minimal')

@section('title', __('Akses dilarang - '))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Maaf ya, Anda tidak berhak mengakses halaman ini, jika mengalami masalah silahkan hubungi kami.'))
