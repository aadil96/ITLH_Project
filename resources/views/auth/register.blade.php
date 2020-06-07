@extends('layouts.app')

@section('navbar-links')

<ul class="navbar-nav ml-auto">
	<li class="nav-item">
		<a class="nav-link" href="{{route('client.register')}}">
			Want to hire ?
		</a>
	</li>
</ul>

@endsection

@section('content')

<style>
	.mandatory {
		color: red;
	}
</style>

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Register') }}</div>

				<div class="card-body">

					<em class="mandatory">Inputs marked * are mandatory</em>

					<form action="{{ route('register')}}" enctype="multipart/form-data" method="post">

						@csrf

						<div class="form-group row">
							<label for="batch" class="col-md-4 col-form-label text-md-right">{{ __('Batch') }}</label>

							<div class="col-md-6">
								<select name="batch" class="custom-select">
									@foreach ($batch as $batch)

									<option value="{{ $batch->id }}">{{ $batch->name }}</option>

									@endforeach
								</select>
							</div>
						</div>

						<div class="form-group row">
							<label for="name" class="col-md-4 col-form-label text-md-right">
								{{ __('Name') }} <p class="mandatory">*</p>
							</label>

							<div class="col-md-6">
								<input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
									name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

								@error('name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="email" class="col-md-4 col-form-label text-md-right">
								{{ __('E-Mail Address') }} <p class="mandatory">*</p>
							</label>

							<div class="col-md-6">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
									name="email" value="{{ old('email') }}" required autocomplete="email">

								@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="phone"
								class="col-md-4 col-form-label text-md-right">{{ __('Contact No.') }}</label>

							<div class="col-md-6">
								<input id="phone" type="number"
									class="form-control @error('phone') is-invalid @enderror" name="phone"
									value="{{ old('phone') }}" autocomplete="phone">

								@error('phone')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="profileImg"
								class="col-md-4 col-form-label text-md-right">{{ __('Profile Image') }}</label>

							<div class="col-md-6">
								<input id="profileImg" type="file"
									class="form-control @error('profileImg') is-invalid @enderror" name="profileImg"
									value="{{ old('profileImg') }}" autocomplete="profileImg">

								@error('profileImg')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="cv" class="col-md-4 col-form-label text-md-right">{{ __('CV') }}</label>

							<div class="col-md-6">
								<input id="cv" type="file" class="form-control @error('cv') is-invalid @enderror"
									name="cv" value="{{ old('cv') }}" autocomplete="cv">

								@error('cv')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="cmpt"
								class="col-md-4 col-form-label text-md-right">{{ __('Competencies') }}</label>

							<div class="col-md-6">
								<input id="cmpt" type="text" class="form-control @error('cmpt') is-invalid @enderror"
									name="cmpt" value="{{ old('cmpt') }}" autocomplete="cmpt">

								@error('cmpt')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="password" class="col-md-4 col-form-label text-md-right">
								{{ __('Password') }} <p class="mandatory">*</p>
							</label>

							<div class="col-md-6">
								<input id="password" type="password"
									class="form-control @error('password') is-invalid @enderror" name="password"
									required autocomplete="new-password">

								@error('password')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
							</div>
						</div>

						<div class="form-group row">
							<label for="password-confirm" class="col-md-4 col-form-label text-md-right">
								{{ __('Confirm Password') }} <p class="mandatory">*</p>
							</label>

							<div class="col-md-6">
								<input id="password-confirm" type="password" class="form-control"
									name="password_confirmation" required autocomplete="new-password">
							</div>
						</div>

						<div class="form-group row mb-0">
							<div class="col-md-6 offset-md-4">
								<button type="submit" class="btn btn-primary">
									{{ __('Register') }}
								</button>
							</div>
						</div>
					</form>

					<!-- <div class="d-block mt-3" style="text-align:right;">
                            <p>
                                Already registered ? Login <a href="{{route('login')}}">here.</a>
                            </p>
                        </div> -->

				</div>
			</div>
		</div>
	</div>
</div>

@endsection