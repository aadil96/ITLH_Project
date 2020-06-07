@extends('layouts.app')

@section('navbar-links')
    @include('includes.freelancer-nav-links')
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-8 col-sm-8">
            <div class="card">
                <div class="card-header">Update Profile</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">

                            <form class="form-group" enctype="multipart/form-data
                                  action="/profile/{{$user->id}}/edit"
                                  method="post">
                                @csrf

                                <input type="hidden" name="id"
                                       value="{{$user->id}}">

                                <label for="batch">Batch</label>
                                <select name="batch" class="custom-select">
                                    @foreach ($batch as $batch)

                                        <option value="{{ $batch->id }}">{{ $batch->name }}</option>

                                    @endforeach
                                </select>

                                <label for="name">Name</label>
                                <input type="text" name="name"
                                       class="form-control"
                                       value="{{$user->name}}" required/>

                                <label class="mt-3" for="email">Email</label>
                                <input type="email" class="form-control"
                                       name="email"
                                       value="{{$user->email}}"
                                       required>

                                <label class="mt-3" for="phone">Phone</label>
                                <input type="number" class="form-control"
                                       name="phone"
                                       value="{{$user->phone}}">

                                <label class="mt-3" for="profileImage">Profile Image</label>
                                <input type="file" name="profileImage"
                                       class="form-control">

                                <label class="mt-3" for="cv">CV</label>
                                <input type="file" name="cv"
                                       class="form-control">

                                <label class="mt-3" for="competencies">Competencies</label>
                                <input type="text" name="competencies"
                                       value="{{ $user->competencies }}"
                                       class="form-control">

                                <label class="mt-3"
                                       for="password">Password</label>
                                <input type="password" class="form-control"
                                       name="password" required value="">

                                <button class="btn btn-primary mt-3">Update
                                </button>
                            </form>

                            @include('includes.errors')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
