@extends('layouts.app')

{{--@section('script')--}}

{{--    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>--}}

{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}

{{--@endsection--}}

@section('content')

<style>

    .mandatory
    {
        color: red;
    }
    
</style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">

                    <!-- <form action="/register/user" method="get">

                            <div class="form-group row">
                                <label for="userType"
                                       class="col-md-4 col-form-label text-md-right">{{ __('User Type') }}</label>

                                <div class="col-md-6">
                                    <select id="userType" onChange="myFunc()"
                                            class="form-control @error('userType') is-invalid @enderror" name="userType"
                                            required>
                                        <option value="flncr">Freelancer</option>
                                        <option value="client">Client</option>
                                        <option value="admin">Admin</option>
                                    </select>

                                    @error('userType')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                        </div>
                    </div>

                </form> -->

                        <!-- <div id='view'> -->

                        <!-- </div> -->

                        <em class="mandatory">Inputs marked * are mandatory</em>

                        <form action="{{ route('register') }}" enctype="multipart/form-data" method="post">

                            @csrf

                            <div class="form-group row">
                                <label for="batch"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Batch') }}</label>

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
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">
                                        {{ __('E-Mail Address') }} <p class="mandatory">*</p>
                                   </label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email">

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
                                           class="form-control @error('profileImg') is-invalid @enderror"
                                           name="profileImg" value="{{ old('profileImg') }}" autocomplete="profileImg">

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
                                    <input id="cmpt" type="text"
                                           class="form-control @error('cmpt') is-invalid @enderror" name="cmpt"
                                           value="{{ old('cmpt') }}" autocomplete="cmpt">

                                    @error('cmpt')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">
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
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">
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

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        // $(document).ready(function () {

        //     let userType = $('#userType').val();

        //     if (userType === 'flncr') {
        //         console.log('freelancer');
        //         let view = '';

        //         view += "<form action='' method=''>"

        //         view += " <div class='form-group row'>"
        //         view += "<label for='name' class='col-md-4 col-form-label text-md-right'>{{ __('Name') }}</label>"
        //         view += "<div class='col-md-6'>"
        //         view += "<input id='name' class='form-control' type='text'>"
        //         view += "</div>"
        //         view += "</div>"

        //         view += " <div class='form-group row'>"
        //         view += "<label for='email' class='col-md-4 col-form-label text-md-right'>{{ __('E-Mail') }}</label>"
        //         view += "<div class='col-md-6'>"
        //         view += "<input id='email' class='form-control' type='text'>"
        //         view += "</div>"
        //         view += "</div>"

        //         view += "<div class='form-group row'>"
        //         view += "<label for='phone' class='col-md-4 col-form-label text-md-right'>{{ __('Phone') }}</label>"
        //         view += "<div class='col-md-6'>"
        //         view += "<input id='phone' class='form-control' type='text'>"
        //         view += "</div>"
        //         view += "</div>"

        //         view += "<div class='form-group row'>"
        //         view += "<label for='profileImg' class='col-md-4 col-form-label text-md-right'>{{ __('Profile Image') }}</label>"
        //         view += "<div class='col-md-6'>"
        //         view += "<input id='profileImg' class='form-control' type='file'>"
        //         view += "</div>"
        //         view += "</div>"

        //         view += "<div class='form-group row'>"
        //         view += "<label for='cv' class='col-md-4 col-form-label text-md-right'>{{ __('CV') }}</label>"
        //         view += "<div class='col-md-6'>"
        //         view += "<input id='cv' class='form-control' type='file'>"
        //         view += "</div>"
        //         view += "</div>"

        //         view += "<div class='form-group row'>"
        //         view += "<label for='cmpt' class='col-md-4 col-form-label text-md-right'>{{ __('Competencies') }}</label>"
        //         view += "<div class='col-md-6'>"
        //         view += "<input id='cmpt' class='form-control' type='text'>"
        //         view += "</div>"
        //         view += "</div>"

        //         view += "<div class='form-group row'>"
        //         view += "<label for='password' class='col-md-4 col-form-label text-md-right'>{{ __('Password') }}</label>"
        //         view += "<div class='col-md-6'>"
        //         view += "<input id='password' class='form-control' type='text'>"
        //         view += "</div>"
        //         view += "</div>"

        //         view += "<div class='form-group row mb-0'>"
        //         view += "<div class='col-md-6 offset-md-4'>"
        //         view += "<button type='submit' class='btn btn-primary'>{{ __('Register') }}</button>"
        //         view += "</div>"
        //         view += "</div>"

        //         view += "</form>"

        //         $('#view').html(view);
        //     }


        // });

        // function myFunc()
        // {

        //     let userType = $('#userType').val();

        //     if (userType === 'client') {
        //         console.log('client');

        //         let view = '';

        //         view += "<form action='' method=''>"

        //         view += " <div class='form-group row'>"
        //         view += "<label for='profileImg' class='col-md-4 col-form-label text-md-right'>{{ __('Profile Image') }}</label>"
        //         view += "<div class='col-md-6'>"
        //         view += "<input id='profileImg' class='form-control' type='file'>"
        //         view += "</div>"
        //         view += "</div>"

        //         view += " <div class='form-group row'>"
        //         view += "<label for='company' class='col-md-4 col-form-label text-md-right'>{{ __('Company Name') }}</label>"
        //         view += "<div class='col-md-6'>"
        //         view += "<input id='company' class='form-control' type='text'>"
        //         view += "</div>"
        //         view += "</div>"

        //          view += " <div class='form-group row'>"
        //         view += "<label for='mail' class='col-md-4 col-form-label text-md-right'>{{ __('E-Mail') }}</label>"
        //         view += "<div class='col-md-6'>"
        //         view += "<input id='mail' class='form-control' type='text'>"
        //         view += "</div>"
        //         view += "</div>"

        //         view += "<div class='form-group row mb-0'>"
        //         view += "<div class='col-md-6 offset-md-4'>"
        //         view += "<button onclick='regClient()' type='button' class='btn btn-primary'>{{ __('Register') }}</button>"
        //         view += "</div>"
        //         view += "</div>"

        //         view += "</form>"

        //         $('#view').html(view);
        //     }
        //     else if (userType === 'admin')
        //     {
        //         console.log('admin');

        //         let view = '';

        //         view += "<form action='' method=''>"

        //         view += " <div class='form-group row'>"
        //         view += "<label for='name' class='col-md-4 col-form-label text-md-right'>{{ __('Name') }}</label>"
        //         view += "<div class='col-md-6'>"
        //         view += "<input id='name' class='form-control' type='text'>"
        //         view += "</div>"
        //         view += "</div>"

        //         view += " <div class='form-group row'>"
        //         view += "<label for='mail' class='col-md-4 col-form-label text-md-right'>{{ __('E-Mail') }}</label>"
        //         view += "<div class='col-md-6'>"
        //         view += "<input id='mail' class='form-control' type='email'>"
        //         view += "</div>"
        //         view += "</div>"

        //         view += " <div class='form-group row'>"
        //         view += "<label for='pswd' class='col-md-4 col-form-label text-md-right'>{{ __('Password') }}</label>"
        //         view += "<div class='col-md-6'>"
        //         view += "<input id='pswd' class='form-control' type='password'>"
        //         view += "</div>"
        //         view += "</div>"

        //         view += "<div class='form-group row mb-0'>"
        //         view += "<div class='col-md-6 offset-md-4'>"
        //         view += "<button onclick='regAdmin' type='button' class='btn btn-primary'>{{ __('Register') }}</button>"
        //         view += "</div>"
        //         view += "</div>"

        //         view += "</form>"

        //         $('#view').html(view);


        //     }
        //     else
        //     {
        //         console.log('freelancer');

        //         let view = '';

        //         view += "<form action='' method=''>"

        //         view += " <div class='form-group row'>"
        //         view += "<label for='name' class='col-md-4 col-form-label text-md-right'>{{ __('Name') }}</label>"
        //         view += "<div class='col-md-6'>"
        //         view += "<input id='name' class='form-control' type='text'>"
        //         view += "</div>"
        //         view += "</div>"

        //         view += " <div class='form-group row'>"
        //         view += "<label for='email' class='col-md-4 col-form-label text-md-right'>{{ __('E-Mail') }}</label>"
        //         view += "<div class='col-md-6'>"
        //         view += "<input id='email' class='form-control' type='text'>"
        //         view += "</div>"
        //         view += "</div>"

        //         view += "<div class='form-group row'>"
        //         view += "<label for='phone' class='col-md-4 col-form-label text-md-right'>{{ __('Phone') }}</label>"
        //         view += "<div class='col-md-6'>"
        //         view += "<input id='phone' class='form-control' type='text'>"
        //         view += "</div>"
        //         view += "</div>"

        //         view += "<div class='form-group row'>"
        //         view += "<label for='profileImg' class='col-md-4 col-form-label text-md-right'>{{ __('Profile Image') }}</label>"
        //         view += "<div class='col-md-6'>"
        //         view += "<input id='profileImg' class='form-control' type='file'>"
        //         view += "</div>"
        //         view += "</div>"

        //         view += "<div class='form-group row'>"
        //         view += "<label for='cv' class='col-md-4 col-form-label text-md-right'>{{ __('CV') }}</label>"
        //         view += "<div class='col-md-6'>"
        //         view += "<input id='cv' class='form-control' type='file'>"
        //         view += "</div>"
        //         view += "</div>"

        //         view += "<div class='form-group row'>"
        //         view += "<label for='cmpt' class='col-md-4 col-form-label text-md-right'>{{ __('Competencies') }}</label>"
        //         view += "<div class='col-md-6'>"
        //         view += "<input id='cmpt' class='form-control' type='text'>"
        //         view += "</div>"
        //         view += "</div>"

        //         view += "<div class='form-group row'>"
        //         view += "<label for='password' class='col-md-4 col-form-label text-md-right'>{{ __('Password') }}</label>"
        //         view += "<div class='col-md-6'>"
        //         view += "<input id='password' class='form-control' type='text'>"
        //         view += "</div>"
        //         view += "</div>"

        //         view += "<div class='form-group row mb-0'>"
        //         view += "<div class='col-md-6 offset-md-4'>"
        //         view += "<button type='submit' class='btn btn-primary'>{{ __('Register') }}</button>"
        //         view += "</div>"
        //         view += "</div>"

        //         view += "</form>"

        //         $('#view').html(view);
        //     }
        // }


        // function regAdmin()
        //         {
        //             let name = document.querySelector('#name').value;

        //             $.ajax({
        //                 headers: {
        //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                   },
        //                 data: name,
        //                 url: "{{ route('register') }}",
        //                 method: 'POST',
        //                 success: function (data) {
        //                     console.log('data');
        //                 },
        //                 error: function() {
        //                     console.log('no');
        //                 }
        //             });
        //         }

    </script>
@endsection
