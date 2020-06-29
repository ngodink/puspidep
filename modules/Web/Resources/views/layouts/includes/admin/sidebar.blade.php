<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="sidebar_accordion">
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('web::index') }}">
		<div class="sidebar-brand-icon">
			<img src="{{ asset('img/logo/rounded-bw-32.png') }}" alt="" width="24">
		</div>
		<div class="sidebar-brand-text mx-2">{{ config('app.name') }}</div>
	</a>
	<hr class="sidebar-divider my-0">
	<li class="nav-item">
		<a class="nav-link" href="{{ route('web::admin.dashboard') }}">
			<i class="mdi mdi-home-outline"> </i> <span> Dasbor </span>
		</a>
	</li>
	<hr class="sidebar-divider">
	<div class="sidebar-heading"> Kelola </div>
	<li class="nav-item">
		<a class="nav-link" data-target="#sidebar_posts" data-toggle="collapse" href="#" href="javascript:;">
			<i class="mdi mdi-newspaper"> </i> <span> Postingan </span>
		</a>
		<div class="collapse" data-parent="#sidebar_accordion" id="sidebar_posts">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="{{ route('web::admin.posts.index') }}"> Semua postingan </a>
			</div>
		</div>
	</li>
	{{-- <hr class="sidebar-divider">
	<div class="sidebar-heading"> Interface </div>
	<li class="nav-item">
		<a  class="nav-link collapsed" data-target="#collapseTwo" data-toggle="collapse" href="#">
			<i class="fas fa-fw fa-cog"> </i>
			<span> Components </span>
		</a>
		<div class="collapse" data-parent="#sidebar_accordion" id="collapseTwo">
			<div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header"> Custom Components: </h6>
				<a class="collapse-item" href="buttons.html"> Buttons </a>
				<a class="collapse-item" href="cards.html"> Cards </a>
			</div>
		</div>
	</li>
	<li class="nav-item">
		<a  class="nav-link collapsed" data-target="#collapseUtilities" data-toggle="collapse" href="#">
			<i class="fas fa-fw fa-wrench"> </i>
			<span> Utilities </span>
		</a>
		<div class="collapse" data-parent="#sidebar_accordion" id="collapseUtilities">
			<div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header"> Custom Utilities: </h6>
				<a class="collapse-item" href="utilities-color.html"> Colors </a>
				<a class="collapse-item" href="utilities-border.html"> Borders </a>
				<a class="collapse-item" href="utilities-animation.html"> Animations </a>
				<a class="collapse-item" href="utilities-other.html"> Other </a>
			</div>
		</div>
	</li>
	<hr class="sidebar-divider">
	<div class="sidebar-heading"> Addons </div>
	<li class="nav-item">
		<a  class="nav-link collapsed" data-target="#collapsePages" data-toggle="collapse" href="#">
			<i class="fas fa-fw fa-folder"> </i>
			<span> Pages </span>
		</a>
		<div class="collapse" data-parent="#sidebar_accordion" id="collapsePages">
			<div class="bg-white py-2 collapse-inner rounded">
				<h6 class="collapse-header"> Login Screens: </h6>
				<a class="collapse-item" href="login.html"> Login </a>
				<a class="collapse-item" href="register.html"> Register </a>
				<a class="collapse-item" href="forgot-password.html"> Forgot Password </a>
				<div class="collapse-divider">
				</div>
				<h6 class="collapse-header"> Other Pages: </h6>
				<a class="collapse-item" href="404.html"> 404 Page </a>
				<a class="collapse-item" href="blank.html"> Blank Page </a>
			</div>
		</div>
	</li> --}}
	<hr class="sidebar-divider">
	<div class="sidebar-heading"> Akun saya </div>
	<li class="nav-item">
		<a class="nav-link" href="{{ route('account::index') }}">
			<i class="mdi mdi-account-circle-outline"> </i> <span> Profil </span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="{{ route('account::password', ['next' => url()->current()]) }}">
			<i class="mdi mdi-lock-outline"> </i> <span> Ubah password </span>
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="{{ route('account::auth.logout') }}" onclick="event.preventDefault(); $('#logout-form').submit();">
			<i class="mdi mdi-logout"> </i> <span> Logout </span>
		</a>
	</li>
	<hr class="sidebar-divider d-none d-md-block">
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle">
		</button>
	</div>
</hr>
</hr>
</hr>
</hr>
</ul>