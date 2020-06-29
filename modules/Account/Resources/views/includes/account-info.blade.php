<div class="card">
	<div class="card-header"><i class="mdi mdi-account-circle-outline"></i> Informasi akun</div>
	<div class="card-body">
		@foreach([
				'Nama lengkap' => auth()->user()->profile->full_name,
				'Username' => auth()->user()->full_username,
				'Bergabung sejak' => auth()->user()->created_at->diffForHumans()
			] as $__k => $__v)
			<p @if($loop->last) class="mb-0" @endif>{{ $__k }} <br> <strong>{!! $__v !!}</strong></p>
		@endforeach
	</div>
	<div class="list-group list-group-flush border-top">
		<a class="list-group-item list-group-item-action text-warning" href="{{ route('account::index') }}">
			<i class="mdi mdi-eye-outline"></i> Lihat detail
		</a>
	</div>
</div>