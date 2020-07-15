@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
	<div class="col-4">
		<div class="justify-content-center">
			<div class="card">
				<div class="card-body m-auto">

					<a class="c0l-4" href="{{ route('admin.login') }}">Admin Login</a>
					<a class="col-4" href="{{ route('admin.register')}}">Admin Register</a>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection