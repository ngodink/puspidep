<nav class="navbar navbar-expand-sm navbar-light bg-white border-bottom">
	<div class="container">
		<a class="navbar-brand" href="/">
			<img src="{{ asset('img/logo/rounded-bw-128.png') }}" width="30" height="30" class="mr-2">
			<small class="pl-1 font-weight-bold text-gray-800">Akun saya</small>
		</a>
		<ul class="navbar-nav ml-auto flex-row align-items-center">
			<li class="nav-item mr-0 dropdown">
				<a class="nav-link" href="javascript:;" role="button" data-toggle="dropdown">
					<img src="{{ auth()->user()->profile->avatar_path }}" alt="" height="32" class="rounded-circle">
				</a>
				<div class="dropdown-menu dropdown-menu-right position-absolute">
					<a class="dropdown-item" href="{{ route('account::index') }}">Profil saya</a>
					<a class="dropdown-item" href="{{ route('account::password', ['next' => url()->full()]) }}">Ubah password</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="{{ route('account::auth.logout') }}" onclick="event.preventDefault(); $('#logout-form').submit();">Logout</a>
				</div>
			</li>
		</ul>
	</div>
</nav>