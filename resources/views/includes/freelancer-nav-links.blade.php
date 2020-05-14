<ul class="navbar-nav ml-auto">
	<li class="nav-item ml-auto">
		<a class="navbar-text nav-link" href="{{route('freelancer.profile', ['user' => Auth::user()->id])}}">Profile</a>
	</li>
	<li class="nav-item ml-auto">
		<a class="navbar-text nav-link" href="{{route('logout')}}">Logout</a>
	</li>
</ul>