<div class="form-group required">
	<label>Alamat e-mail</label>
	<input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email->address) }}" required>
	@error('email')
		<small class="text-danger"> {{ $message }} </small>
	@enderror
</div>
@if ($user->email->address) 
	<div class="form-group">
		<div class="mb-1">Status verifikasi</div>
		@if ($user->email->verified_at) 
			<div class="text-warning"><i class="icon-check"></i> Terverifikasi</div>
		@else
			<div class="text-danger"><i class="icon-close"></i> Belum terverifikasi</div>
			<a class="content-block" href="{{ route('account::user.email.reverify', ['uid' => encrypt($user->email->id), 'next' => ($next ?? route('account::index'))]) }}">Kirim tautan verifikasi sekarang!</a>
		@endif
	</div>
@endif
<div class="form-group mb-0">
	<button class="btn btn-success" type="submit">Simpan</button>
	@isset($back)
		<a class="btn btn-secondary" href="{{ request('next', route('account::index')) }}">Kembali</a>
	@endisset
</div>
@if ($user->email->verified_at)
<hr>
<p class="mb-0">
	<strong>Peringatan!</strong> <br>
	Jika Anda mengubah alamat e-mail {{ $user->profile->display_name }}, kami akan melakukan verifikasi ulang terhadap e-mail tersebut
</p>
@endif