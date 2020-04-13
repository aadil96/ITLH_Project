@extends('layouts.app')

@section('content')

<style type="text/css">
	
	.profile{
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
					<div class="card-header"><h2>Profile</h2></div>
					
					<div class="card-body">
						<div class="row">
							<div class="col-md-3 p-0 pl-3">
								<img src="/images/img_avatar.png" class="profile">
							</div>

							<div class="col-md-8 p-0">
								<div class="row">
									<div class="col-12">
										<h2 class="company mt-5">{{$client->company_name}}</h2>
									</div>

									<div class="col-12">
										<h5>Mail: {{$client->email}}</h5>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-4 mt-4">
								<h5>Total Assignments: {{$assignment->count()}}</h5>
							</div>

							<div class="col-4 mt-4">
								<h5>Hires: 0</h5>
							</div>
						</div>

						<div class="row mt-3">
							<div class="col-md-10">
								<h5>Overwierw:</h5>

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