@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
	<div class="col-lg-7 col-sm-7">
		<div class="card">
			<div class="card-header">
				Admin login
			</div>
			<div class="card-body">
				<form class="form-group" action="/admin/register" method="post">

					@csrf

					<label for="name">Name</label>
					<input class="form-control" type="text" name="name" id="" autofocus>

					<label class="mt-2" for="email">Email</label>
					<input class="form-control" type="email" name="email" id="">

					<label class="mt-2" for="password">Password</label>
					<input class="form-control" type="password" name="password" id="">

					<button type="submit" class="btn btn-primary mt-3">Register</button>
				</form>

				<div>
					<p><a href="{{ route('admin.login') }}">Login</a> Admin.</p>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection