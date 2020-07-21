@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
	<div class="col-lg-7 col-sm-7">
		<div class="card">
			<div class="card-header">
				Admin login
			</div>
			<div class="card-body">
				<form class="form-group" action="/admin/login" method="POST">
					@csrf
					<label for="email">Email</label>
					<input class="form-control" type="email" name="email" value="{{old('email')}}" required autofocus>

					<label class="mt-2" for="password">Password</label>
					<input class="form-control" type="password" name="password" value="{{old('password')}}" required>

					<button type="submit" class="btn btn-primary mt-3">Log in</button>
				</form>

				<div class="mt-5">
					@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
					@endif
				</div>

				<div>
					<p><a href="{{ route('admin.register') }}">Register</a> Admin.</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection