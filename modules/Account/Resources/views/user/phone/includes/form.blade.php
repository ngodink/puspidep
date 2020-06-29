<div class="form-group required">
	<label>Nomor HP</label>
	<input type="number" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('number', $user->phone->number ?? 62) }}" required data-mask="62#">
	<small class="form-text text-muted">Ditulis menggunakan kode negara, misal 085123xxxxx menjadi 6285123xxxxx (tanpa tanda plus).</small>
	@error('number')
		<small class="text-danger"> {{ $message }} </small>
	@enderror
</div>
<div class="form-group">
	<div class="custom-control custom-checkbox">
		<input class="custom-control-input" type="checkbox" id="whatsapp" value="1" name="whatsapp" @if($user->phone->whatsapp) checked @endif>
		<label class="custom-control-label" for="whatsapp">Nomor ini <strong><span id="whatsapp-text">@if(!$user->phone->whatsapp) tidak @endif</span> terdaftar</strong> di whatsapp</label>
	</div>
</div>
<div class="form-group mb-0">
	<button class="btn btn-success" type="submit">Simpan</button>
	@isset($back)
		<a class="btn btn-secondary" href="{{ request('next', route('account::index')) }}">Kembali</a>
	@endisset
</div>