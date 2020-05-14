@extends('layouts.app')

@section('navbar-links')

<ul class="navbar-nav ml-auto">
	<li class="nav-item">
		<a class="navbar-text nav-link" href="{{ route('client.home') }}">Home</a>
	</li>
	<li class="nav-item">
		<a class="navbar-text nav-link" href="{{ route('client.logout') }}">Logout</a>
	</li>
</ul>

@endsection

@section('content')

<style type="text/css">
	.profile {
		border-radius: 50%;
		/*border: 2px solid;*/
		width: 150px;
		height: 150px;
	}
</style>

<div class="">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					<h2>Profile</h2>
				</div>

				<div class="card-body">

					<div class="row">
						<div class="col-md-3 p-0 pl-3">
							<img src="/storage/{{$client->profile_image}}" class="profile" alt="no image">
						</div>

						<div class="col-md-8 p-0">
							<!-- <div class="row"> -->
							<div class="ml-4">
								<h2 class="company mt-5">{{$client->company_name}}</h2>
							</div>

							<div class="ml-4">
								<h5><span class="fa fa-envelope-o"></span> {{$client->email}}</h5>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-4 mt-4">
							<h5>Total Assignments: {{$assignment->count()}}</h5>
						</div>

						<div class="col-4 mt-4">
							<h5>Hires: {{$approved->count()}}</h5>
						</div>
					</div>

					<div class="row mt-3">
						<div class="col-md-10">
							<h5>Overview:</h5>

							<p class="mt-3">lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
								tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
								quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
								consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
								cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
								proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
						</div>
					</div>

					<div class="">
						<a href="{{route('client.edit', ['client' => $client->id])}}">Edit Profile</a>
					</div>

				</div>
			</div>
		</div>
	</div>

</div>

@endsection