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

	<div class="container">
		<h5>Applicant name:</h5>
			<strong>{{ucfirst($proposal->user->name)}} - </strong>

			<a href="" class="text-right">View Profile</a>
	</div>

	<div class="container mt-4">
		<h5>Cover Letter:</h5>
		{{ $proposal->cover_letter }}
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

@endsection
