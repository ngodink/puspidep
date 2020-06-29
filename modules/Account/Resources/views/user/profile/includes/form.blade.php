<fieldset>
	<div class="row">
		<div class="col-md-7 offset-md-4 offset-lg-3">
			<h5 class="text-muted font-weight-normal mb-3">Informasi umum</h5>
		</div>
	</div>

	<div class="form-group row">
		<label class="col-md-4 col-lg-3 col-form-label">Gelar depan</label>
		<div class="col-md-4">
			<input type="prefix" class="form-control @error('prefix') is-invalid @enderror" name="prefix" value="{{ old('prefix', $user->profile->prefix) }}" >
			@error('prefix')
			<span class="invalid-feedback"> {{ $message }} </span>
			@enderror
		</div>
	</div>

	<div class="form-group required row">
		<label class="col-md-4 col-lg-3 col-form-label">Nama lengkap</label>
		<div class="col-md-7">
			<input type="name" class="form-control @error('name') is-invalid @enderror " name="name" value="{{ old('name', $user->profile->name) }}" required>
			<small class="form-text text-muted">Nama lengkap (tidak boleh disingkat) diisi menggunakan huruf kapital sesuai Akta/KTP/KK atau identitas resmi lainnya.</small>
			@error('name')
			<span class="invalid-feedback"> {{ $messagae }} </span>
			@enderror
		</div>
	</div>

	<div class="form-group row">
		<label class="col-md-4 col-lg-3 col-form-label">Gelar belakang</label>
		<div class="col-md-4">
			<input type="suffix" class="form-control @error('suffix') is-invalid @enderror" name="suffix" value="{{ old('suffix', $user->profile->suffix) }}">
			@error('suffix')
			<span class="invalid-feedback"> {{ $message }} </span>
			@enderror
		</div>
	</div>

	<div class="form-group required row">
		<label class="col-md-4 col-lg-3 col-form-label">Tempat lahir</label>
		<div class="col-md-5">
			<input type="pob" class="form-control @error('pob') is-invalid @enderror" name="pob" value="{{ old('pob', $user->profile->pob) }}" required>
			<small class="form-text text-muted">Nama lengkap diisi menggunakan huruf kapital sesuai Akta/KTP/KK atau identitas resmi lainnya.</small>
			@error('pob')
			<span class="invalid-feedback"> {{ $message }} </span>
			@enderror
		</div>
	</div>

	<div class="form-group required row">
		<label class="col-md-4 col-lg-3 col-form-label">Tanggal lahir</label>
		<div class="col-md-5">
			<input type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob', $user->profile->dob ? $user->profile->dob->format('d-m-Y') : '') }}" required>
			<small class="form-text text-muted">Diisi dengan format hh-bb-tttt (ex: 23-02-2001) dan sesuai dengan Kartu Keluarga atau akta kelahiran </small>
			@error('dob')
			<span class="invalid-feedback"> {{ $message }} </span>
			@enderror
		</div>
	</div>

	<div class="form-group required row">
		<label class="col-md-4 col-lg-3 col-form-label">Jenis kelamin</label>
		<div class="col-md-4">
			<div class="btn-group btn-group-toggle" data-toggle="buttons">
				@foreach (\Modules\Account\Models\UserProfile::$sex as $k => $v)
				<label class="btn btn-outline-secondary @if((!is_null($user->profile->sex)) && (old('sex', $user->profile->sex) == $k)) active @endif">
					<input type="radio" name="sex" value="{{ $k }}" required autocomplete="off" @if((!is_null($user->profile->sex)) && (old('sex', $user->profile->sex) == $k)) checked @endif> {{ $v }}
				</label>
				@endforeach
			</div>
			@error('sex')
				<small class="text-danger"> {{ $message }} </small>
			@enderror
		</div>
	</div>

	<div class="form-group row">
		<label class="col-md-4 col-lg-3 col-form-label">Golongan darah</label>
		<div class="col-md-4">
			<select name="blood" class="form-control @error('blood') is-invalid @enderror">
				<option value="">-- Pilih --</option>
				@foreach (\Modules\Account\Models\UserProfile::$blood as $k => $v)
				<option value="{{ $k }}" @if((!is_null($user->profile->blood)) && (old('blood', $user->profile->blood) == $k)) selected @endif>{{ $v }}</option>
				@endforeach
			</select>
			@error('blood')
			<span class="invalid-feedback"> {{ $message }} </span>
			@enderror
		</div>
	</div>
</fieldset>
<hr>
<fieldset>

	<div class="row">
		<div class="col-md-7 offset-md-4 offset-lg-3">
			<h5 class="text-muted font-weight-normal mb-3">Data kewarganegaraan</h5>
		</div>
	</div>
	<div class="form-group row">
		<label class="col-md-4 col-lg-3 col-form-label">NIK</label>
		<div class="col-md-7">
			<input type="number" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik', $user->profile->nik) }}" data-mask="0000000000000000">
			<small class="form-text text-muted">Nomor Induk Kependudukan, sesuai KTP/KK/Identitas resmi lainnya</small>
			@error('nik')
			<span class="invalid-feedback"> {{ $message }} </span>
			@enderror
		</div>
	</div>
</fieldset>
<hr>
<div class="form-group row mb-0">
	<div class="col-md-7 offset-md-4 offset-lg-3">
		<button class="btn btn-success" type="submit">Simpan</button>
		@isset($back)
			<a class="btn btn-secondary" href="{{ request('next', route('account::index')) }}">Kembali</a>
		@endisset
	</div>
</div>