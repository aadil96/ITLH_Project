@extends('layouts.app')

@section('navbar-links')
@include('includes.client-nav-links')
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8 col-sm-8">
        <div class="card">
            <div class="card-header">Update Profile</div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-lg-6">

                        <form class="form-group" action="/client/profile/{{$client->id}}/edit" method="post">
                            @csrf

                            <input type="hidden" name="id" value="{{$client->id}}">

                            <label for="name">Enter new name</label>
                            <input type="text" name="company_name" class="form-control"
                                placeholder="{{$client->company_name}}" required />

                            <label class="mt-3" for="email">Enter new email</label>
                            <input type="email" class="form-control" name="email" placeholder="{{$client->email}}"
                                required>

                            <label class="mt-3" for="password">New Password</label>
                            <input type="password" class="form-control" name="password" required value="">

                            <button class="btn btn-primary mt-3">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection