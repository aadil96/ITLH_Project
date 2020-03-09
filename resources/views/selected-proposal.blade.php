@extends('layouts.app')

@section('content')
	
	<div class="container">
		<h5>Applicant name:</h5>
			<strong>{{ucfirst($proposal->user->name)}}</strong>
	</div>

	<div class="container mt-4">
		<h5>Cover Letter:</h5>
		{{ $proposal->cover_letter }}
	</div>

@endsection