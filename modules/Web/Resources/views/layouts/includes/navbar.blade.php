<div class="navbar-expand py-3">
	<div class="container">
		<div class="d-sm-flex flex-row justify-content-sm-between align-items-center text-center">
			<div>
				<a class="navbar-brand text-dark py-3" href="{{ route('web::index') }}">
					<img class="pr-1" src="{{ asset('img/logo/full.png') }}" alt="" style="margin-top: -5px;width: 300px;">
				</a>
			</div>
			<div>
				<a class="text-dark mr-2" href="{{ route('web::about') }}"><small>Tentang kami</small></a>
				<a class="mr-2" style="color: #3b5998" href="https://www.facebook.com/puspidep.puspidep.9"><i class="mdi mdi-facebook"></i></a>
				<a class="mr-2" style="color: #1da1f2" href="#"><i class="mdi mdi-twitter"></i></a>
				<a class="mr-2" style="color: #e1306c" href="https://www.instagram.com/puspidep"><i class="mdi mdi-instagram"></i></a>
				@auth
					@can('admin')
						<a class="text-dark mr-2" href="{{ route('web::admin.dashboard') }}"><small>Admin</small></a>
					@endcan
					<a class="text-dark" href="{{ route('account::auth.logout') }}" onclick="event.preventDefault(); $('#logout-form').submit();"><small>Logout</small></a>
				@else
					<a class="text-dark" href="{{ route('account::auth.login', ['next' => url()->current()]) }}"><small>Login</small></a>
				@endauth
			</div>
		</div>
	</div>
</div>

<nav class="navbar navbar-expand navbar-dark bg-dark overflow-auto mb-4 border-bottom-success">
	<div class="container">
		<ul class="navbar-nav d-sm-flex flex-row justify-content-sm-between w-100">
			<li class="nav-item text-nowrap">
				<a class="nav-link" href="{{ route('web::index') }}">
					<i class="mdi mdi-home-outline mdi-18px" style="line-height: 1.4rem;"></i>
				</a>
			</li>
			<li class="nav-item text-nowrap">
				<a class="nav-link" href="{{ route('web::about') }}">Tentang kami</a>
			</li>
			@foreach($BLOG_CATEGORIES as $__category)
				<li class="nav-item text-nowrap">
					<a class="nav-link" href="{{ route('web::category', ['category' => $__category->slug]) }}">{{ $__category->name }}</a>
				</li>
			@endforeach
		</ul>
	</div>
</nav>