<ul class="navbar-nav ml-auto">
	<li class="nav-item ml-auto">
		<a class="navbar-text nav-link" href="{{route('client.profile', ['client' => Auth::user()->id])}}">Profile</a>
	</li>
	<li class="nav-item ml-auto">
		<a class="navbar-text nav-link" href="{{route('client.logout')}}">Logout</a>
	</li>
</ul>
