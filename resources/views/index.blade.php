@extends('layouts.app')

@section('content')

	<style type="text/css">

		.navbar-brand
		{
			opacity: 70%;
		}
		
		#brand
		{
			opacity: 70%;
			font-size: 80px;
			margin-top: 120px;
		}

		h4
		{
			opacity: 50%;
			font-size: 40px;
			font-weight: 700;
		}

		#postJob, #applyJob
		{
			padding: 15px;
			border-radius: 13px;
			font-size: 1.2rem;
		}

	</style>

	<h1 id="brand"><strong>MarketPlace.</strong></h1>


		<!-- SEARCH FORM -->
		
	<form class="mt-5">
		<h4>What are you looking for?</h4>

		<div class="form-inline">	
			<input class="form-control form-control-lg mr-3 w-75 h-100" type="text" placeholder="Search" aria-label="Search">
	  		<i class="fa fa-search mr-2" aria-hidden="true"></i>
		</div>
	</form>

	<!-- POST and APPLY BUTTON -->

	<form>
		<button id="postJob" class="btn btn-light border-dark mt-3">Post a Job</button>
		<button id="applyJob" class="btn btn-dark ml-3 mt-3">Apply for a job</button>
	</form>

	
@endsection