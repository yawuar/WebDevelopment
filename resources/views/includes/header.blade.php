{{-- <div id="logo-banner">
	<a class="logo" href="{{ route('contest.home') }}"></a>
</div>

<div id="user-banner">
	<div class="user-management">
		<a class="image-wrapper" href="{{ route('login') }}">
			<img src="{{ (Auth::check() && Auth::user()['photo_path'] != null) ? url(Auth::user()['photo_path']) : url('/images/users/avatar.png') }}" alt="{{ (Auth::check()) ? strtolower(Auth::user()['firstname']) : 'avatar' }}" width="50">
		</a>
		<div class="content">
			<h4>{{ (Auth::check()) ? Auth::user()['firstname'] : 'Avatar' }}</h4>
			<a href="{{ (Auth::check()) ? route('logout') : route('login') }}">{{ (Auth::check()) ? 'Logout' : 'Login' }}</a>
		</div>
	</div>
</div> --}}

<nav id="navigation">
	<div class="container-fluid">
		<div id="logo-banner">
			<a class="logo" href="{{ route('contest.home') }}"></a>
		</div>

		<div id="user-banner">
			<div class="user-management">
				<a class="image-wrapper">
					<img src="{{ (Auth::check() && Auth::user()['photo_path'] != null) ? url(Auth::user()['photo_path']) : url('/images/users/avatar.png') }}" alt="{{ (Auth::check()) ? strtolower(Auth::user()['firstname']) : 'avatar' }}" width="45" height="45">
				</a>
				<div class="content">
					<div class="inner">
						<h4>{{ (Auth::check()) ? Auth::user()['firstname'] . ' ' . Auth::user()['lastname'] : 'Avatar' }}</h4>
						<a href="{{ route('admin.index') }}">{{ (Auth::check() && Auth::user()['is_admin']) ? 'admin' : '' }} </a>
						<a href="{{ (Auth::check()) ? route('logout') : route('login') }}">{{ (Auth::check()) ? 'Logout' : 'Login' }}</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</nav>