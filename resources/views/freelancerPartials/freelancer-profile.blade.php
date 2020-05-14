@extends('layouts.app')

@section('navbar-links')

@auth('web')
<ul class="navbar-nav ml-auto">
	<li class="nav-item ml-auto">
		<a class="navbar-text nav-link" href="{{ route('freelancer.home') }}">Home</a>
	</li>
	<li class="nav-item ml-auto">
		<a class="navbar-text nav-link" href="{{ route('logout') }}">Logout</a>
	</li>
</ul>
@endauth

@auth('client')
<ul class="navbar-nav ml-auto">
	<li class="nav-item ml-auto">
		<a class="navbar-text nav-link" href="{{ route('client.home') }}">Home</a>
	</li>
	<li class="nav-item ml-auto">
		<a class="navbar-text nav-link" href="{{ route('logout') }}">Logout</a>
	</li>
</ul>
@endauth

@endsection

@section('content')

<style type="text/css">
	.profileImg {
		border-radius: 50%;
		/*border: 2px solid;*/
		width: 150px;
		height: 150px;
	}
</style>

<div class="">
	<div class="row justify-content-center">
		<div class="col-lg-8 col-sm-8">
			<div class="card">
				<div class="card-header">
					<h2>Profile</h2>
				</div>

				<div class="card-body">
					<div class="row">
						<div class="col-lg-3 col-sm-3 p-0 pl-3">
							<img src="/images/img_avatar.png" class="profileImg">
						</div>

						<div class="col-lg-8 col-sm-8 p-0">
							<!-- <div class="row"> -->
							<div class="ml-4">
								<h2 class="company mt-5">{{$user->name}}</h2>
							</div>

							<div class="ml-4">
								<h5><span class="fa fa-envelope-o"></span> {{$user->email}}</h5>
							</div>
							<!-- </div> -->
						</div>
					</div>

					<div class="row">
						<div class="col-lg-4 col-sm-4 mt-4">
							<h5>Completed work: {{$completed->count()}}</h5>
						</div>

						<div class="col-lg-4 col-sm-4 mt-4">
							<h5>Currently working on: {{$approved->count()}}</h5>
						</div>

						<div class="col-lg-4 col-sm-4 mt-4">
							<h5>Proposals posted: {{$user->proposals->count()}}</h5>
						</div>
					</div>

					<div class="row mt-3">
						<div class="col-lg-10 col-sm-10">
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
						<a href="">Edit Profile</a>
					</div>

				</div>
			</div>
		</div>
	</div>

</div>

@endsection