@extends('web::layouts.default')

@section('content')
<div class="container text-center mt-5 pt-5">
	<div class="display-2 mb-4">503</div>
	<h4><strong>Mohon maaf!</strong></h4>
	<p class="text-muted">Website <strong>{{ env('APP_URL') }}</strong> sedang mengalami perbaikan, silahkan tunggu beberapa waktu kedepan.</p>
</div>
@endsection