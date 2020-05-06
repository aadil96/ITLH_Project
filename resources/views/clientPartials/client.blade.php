@extends('layouts.app')

@section('navbar-links')
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a
                class="navbar-text nav-link"
                href="{{route('client.profile', ['id' => $user->id])}}">
                Profile
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link navbar-text" href="{{route('client.logout')}}">Logout</a>
        </li>
    </ul>

@endsection

@section('content')

    <style type="text/css">

        #heading {
            font-size: 1.5rem;
        }

        .tagList
        {
            /*background-color: gray;*/
            display: inline-block;
            width: max-content;
            margin: 5px;
            list-style-type: none;
            /*border: 2px solid gray;*/
            border-radius: 5px;
            padding: 5px;
            font-size: 0.8rem;
        }
    </style>

    <div class="row justify-content-center">

        <div class="col-lg-10 col-sm-10">

            <div class="card">
                <div class="card-header">Feed</div>
                <div class="card-body">

                    <!-- Search Bar -->

                    <form action="/client/home" method="get" role="search">
                        {{ csrf_field() }}
                        <div class="input-group">
                            <input type="text" class="form-control mr-2" name="search"
                                   placeholder="Search">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-outline-dark">
                                        <span class="fa fa-search"></span>
                                </button>
                            </span>
                        </div>
                    </form>
                    <br>

                    <!-- Search end -->

                    <a id="post" class="btn btn-dark ml-3 mt-3 mb-5" href="{{route('assignment.post', ['client' => Auth::user()->id])}}">Post Assignment</a>
                    <br>

                                                        <!-- Assignments -->

                    @if($assignments->count() > 0)

                        <table class="table">

                            @foreach($assignments as $assignment)

                                <thead>
                                    <th id="heading">{{ $assignment->title }}</th>
                                </thead>

                                <tbody>

                                <tr>
                                    <td>{{ substr($assignment->description, 0, 100) }} <a class="d-block text-right" href="/assignment/{{ $assignment->id }}">view assignment</a></td>
                                </tr>

                                </tbody>
                            @endforeach

                        </table>

                                                    <!-- Assignment end -->

                   @else
                        {{$message ?? '' ?? ''}}  <!-- error message -->
                   @endif

                    {{$assignments->links()}}  <!-- page links -->
                </div>
            </div>
        </div>

    </div>

@endsection
