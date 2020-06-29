@extends('account::layouts.default')

@section('title', 'Ubah nomor HP - ')

@section('content')
<div class="row justify-content-center">
	<div class="col-sm-10 col-md-8 col-lg-6">
		<h2>
			<a class="text-decoration-none small" href="{{ request('next', route('account::index')) }}"><i class="mdi mdi-arrow-left-circle-outline"></i></a>
			Ubah nomor HP
		</h2>
		<hr>
		<p class="text-secondary">Nomor HP ini digunakan untuk menerima notifikasi dari sistem.</p>
		<div class="card mb-4">
			<div class="card-body">
				<form class="form-block" action="{{ route('account::user.phone', ['next' => request('next')]) }}" method="POST"> @csrf @method('PUT')
					@include('account::user.phone.includes.form', ['user' => $user, 'back' => true])
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@push('script')
	<script>
		$('#whatsapp').on('change', (e) => {
		    $('#whatsapp-text').text($(e.target).is(':checked') ? '' : 'tidak')
		});
	</script>
@endpush