@extends('layouts.app')

{{--@section('script')--}}

{{--    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>--}}

{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}

{{--@endsection--}}

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Post Assignment') }}</div>

                    <div class="card-body">

                        <form action='/post/assignment' enctype="multipart/form-data" method="post">

                            @csrf

                            <div class="form-group row">
                                <label for="title"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Titile') }}</label>

                                <div class="col-md-6">

                                    <!-- <input type="hidden" value="" -->

                                    <input id="title" type="text"
                                           class="form-control @error('title') is-invalid @enderror" name="title"
                                           value="{{ old('title') }}" required autocomplete="title">

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="dscrpt"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                <div class="col-md-6">
                                    <input id="dscrpt" type="text"
                                           class="form-control @error('dscrpt') is-invalid @enderror" name="dscrpt"
                                           value="{{ old('dscrpt') }}" required autocomplete="dscrpt">

                                    @error('dscrpt')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="specs"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Specification') }}</label>

                                <div class="col-md-6">
                                    <input id="specs" type="file"
                                           class="form-control @error('specs') is-invalid @enderror" name="specs"
                                           value="{{ old('specs') }}">

                                    @error('specs')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tat"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Turn Around Time') }}</label>

                                <div class="col-md-6">
                                    <input id="tat" type="text"
                                           class="form-control @error('tat') is-invalid @enderror" name="tat"
                                           value="{{ old('tat') }}" required autocomplete="tat">

                                    @error('tat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="costLow"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Cost Low') }}</label>

                                <div class="col-md-6">
                                    <input id="costLow" type="text"
                                           class="form-control @error('costLow') is-invalid @enderror" name="costLow"
                                           value="{{ old('costLow') }}" required autocomplete="costLow">

                                    @error('costLow')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="costHigh"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Cost High') }}</label>

                                <div class="col-md-6">
                                    <input id="costHigh" type="text"
                                           class="form-control @error('costHigh') is-invalid @enderror" name="costHigh"
                                           value="{{ old('costHigh') }}" required autocomplete="costHigh">

                                    @error('costHigh')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <!-- <form action="/addTag" method="post"> -->
                                <label for="tag"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Tags') }}</label>

                                <div class="col-md-6">
                                    <input id="tag" type="text"
                                           class="form-control @error('tag') is-invalid @enderror" name="tag"
                                           value="{{ old('tag') }}" required autocomplete="tag">

                                    @error('tag')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- </form> -->
                            </div>



                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add Assignment') }}
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
