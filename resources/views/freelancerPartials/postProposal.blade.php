@extends('layouts.app')

@section('navbar-links')

@include('includes.freelancer-nav-links')

@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-10 col-sm-10">
        <div class="card">
            <div class="card-header">
                Cover Letter
            </div>
            <div class="card-body">

                <form action="/assignment/{{$assignment->id}}/proposal/post" method="post" class='form-group'>
                    @csrf

                    <input name='userId' class="form-control" type="hidden" value="{{$user->id}}" autofocus>

                    <input name='assignmentId' class="form-control" type="hidden" value="{{$assignment->id}}">

                    <input name='clientEmail' class="form-control" type="hidden" value="{{$assignment->client->email}}">

                    <input name='coverLetter' class="form-control" type="text">

                    <input name='status' class="form-control" type="hidden" value="Pending Approval">
                    <br>

                    <button class='btn btn-primary' type='submit'>Send</button>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection