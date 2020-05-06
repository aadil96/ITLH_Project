@extends('layouts.app')

@section('title')
	{{ucfirst($proposal->user->name)}} - Cover Letter
@endsection

@section('content')

<style type="text/css">

	#approve,#reject
	{
		padding: 10px;
        border-radius: 13px;
        font-size: 1rem;
	}

</style>

	<div class="row justify-content-center">
		<div class="col-lg-8 col-sm-10">
			<div class="card">
				<div class="card-body">
					<div class="container">

							<h2>{{ucfirst($proposal->user->name)}}</h2>

							<a
							href="{{route('freelancer.profile', ['id' => $proposal->user->id])}}"
							class="text-right">view profile</a>
					</div>

					<div class="container mt-4">
						<h5>Cover Letter:</h5>
						<p>{{ $proposal->cover_letter }}</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
							sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
							Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
							nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
							reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
							pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
							qui officia deserunt mollit anim id est laborum.</p>

					</div>

					<div class="d-flex container mt-5">

						<form action="/assignment/{{$proposal->assignment_id}}/proposal/{{$proposal->id}}/approve" method="post">
							@csrf
							<button class="btn btn-dark ml-3 mt-3" id="approve">Approve</button>
						</form>

						<form action="/assignment/{{$proposal->assignment_id}}/proposal/{{$proposal->id}}/reject" method="post">
							@csrf
							<button class="btn btn-light border-dark ml-3 mt-3" id="reject">Reject</button>
						</form>

					</div>

				</div>
			</div>
		</div>
	</div>

	<!--



	 -->

@endsection
