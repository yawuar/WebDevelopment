<div id="logo-banner">
	<img src="/images/logo.svg" alt="Deliveroo">
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
</div>