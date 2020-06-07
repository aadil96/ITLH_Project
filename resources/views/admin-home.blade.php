@extends('layouts.app')

@section('navbar-links')
    @include('includes.admin-nav-links')
@endsection

@section('content')

    <style>
        .users {
            margin-left: 10%;
        }
    </style>

    <div class="container card mb-3">
        <div class="card-body">
            <h1>Welcome {{ $admin->name }} </h1>
            <p>logged in as admin</p>

            <div class="mt-4">
                <form class="form-group" method="POST" action="/admin/addBatch">
                    @csrf
                    <label for="batchYear">Enter new batch</label>
                    <input id="batchYear" class="form-control" name="batchYear" type="text">

                    <button class="btn btn-primary mt-3" type="submit">submit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container card mt-3 mb-3">
        <div class="card-header">
            All Post
        </div>

        <div class="card-body">
            @if ($assignments->count() > 0)

                <table class="table">
                    <tr>
                        <th>id</th>
                        <th>Project</th>
                        <th>User</th>
                        <th>Aciton</th>
                    </tr>

                    @foreach ($assignments as $assignment)
                        <tr>
                            <td>{{ $assignment->id }}</td>
                            <td>{{ $assignment->title }} <a href="{{ route('assignment', ['id' => $assignment->id]) }}">
                                    view more</a></td>
                            <td>
                                <a href="{{ route('client.profile', ['client' => $assignment->client->id]) }}">{{ $assignment->client->company_name }}</a>
                            </td>
                            <td><a href="{{ route('delete.assignment', ['assignment' => $assignment->id]) }}">Delete</a></td>
                        </tr>
                    @endforeach
                </table>

                {{$assignments->links()}}

            @else
                <p>No projects posted.</p>
            @endif
        </div>
    </div>

    <div class="container row users">
        <div class="col-lg-6 col-sm-6">
            <div class="card mt-3 mb-3">
                <div class="card-header">
                    Freelancers
                </div>
                <div class="card-body">

                    <table class="table">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>

                        @foreach( $users as $user )
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td><a href="{{ route('delete.user', ['user' => $user->id]) }}">Delete</a></td>
                            </tr>
                        @endforeach

                    </table>

                    {{ $users->links() }}

                </div>
            </div>
        </div>

        <div class="col-lg-6 col-sm-6">
            <div class="card mt-3 mb-3">
                <div class="card-header">
                    Clients
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>

                        @foreach( $clients as $client)
                            <tr>
                                <td>{{ $client->id }}</td>
                                <td>{{ $client->company_name }}</td>
                                <td>{{ $client->email }}</td>
                                <td><a href="{{ route('delete.client', ['client' => $client->id]) }}">Delete</a></td>
                            </tr>
                        @endforeach

                    </table>

                    {{ $clients->links() }}

                </div>

            </div>
        </div>
    </div>

@endsection
