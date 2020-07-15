@extends('layouts.app')

@section('navbar-links')

<ul class="navbar-nav ml-auto">
    @guest
    <li class="nav-item">
        <a class="navbar-text nav-link" href="{{route('login')}}">
            Login
        </a>
    </li>

    <li class="nav-item">
        <a href="{{route('register')}}" class="navbar-text nav-link">
            Sign up
        </a>
    </li>

    @endguest

    @auth('web')
    <li class="nav-item">
        <a class="navbar-text nav-link" href="{{route('profile', ['user' => Auth::user()->id])}}">
            Profile
        </a>
    </li>

    <li class="nav-item">
        <a class="navbar-text nav-link" href="{{route('logout')}}">
            Logout
        </a>
    </li>
    @endauth
</ul>

@endsection

@section('content')

<style type="text/css">
    #brand {
        opacity: 70%;
        font-size: 80px;
    }

    #search {
        opacity: 50%;
        font-size: 40px;
        font-weight: 700;
    }

    #hire,
    #work {
        padding: 10px;
        border-radius: 13px;
        font-size: 1.2rem;
    }
</style>

<div class="container-fluid">
    <h1 class="m-0" id="brand"><strong>MarketPlace.</strong></h1>

    <!-- SEARCH FORM -->

    <form class="form-group mt-5" action="/" method="get" role="search">
        {{ csrf_field() }}

        <h2 id="search">What are you looking for ?</h2>
        <div class="col-10 d-inline-flex">
            <input id="searchInput" type="text" class="form-control mr-2" name="search" placeholder="Search job by company name or title" autofocus>
            <span class="form-group-btn">
                <button type="submit" class="btn btn-outline-dark">
                    <span class="fa fa-search"></span>
                </button>
            </span>
        </div>
    </form>

    <!-- POST and APPLY BUTTON -->

    <a class="btn btn-dark ml-3 mt-3 mb-3" href="{{route('assignment.post')}}">Post a job</a>
    <!-- <a id="work" href="{{route('register')}}" class="btn btn-dark ml-3 mt-3"></a> -->
</div>

<div class="container row mt-2 mb-5">
    <div class="col">
        <div class="card">
            <div class="card-header">Feed</div>
            <div class="card-body">

                @if($assignments->count() > 0)

                <table class="table">

                    @if(isSet($showingResultsFor))
                    <p class="mb-3">{{$showingResultsFor}}</p>
                    @endif

                    @foreach($assignments as $assignment)

                    <thead>
                        <th id="heading">{{ $assignment->title }}</th>
                    </thead>

                    <tbody>

                        <tr>
                            <td>{{ substr($assignment->description, 0, 100) }}
                                <a class="d-block text-right" href="/assignment/{{ $assignment->id }}">
                                    View more
                                </a>
                            </td>
                        </tr>

                    </tbody>
                    @endforeach

                </table>

                @else
                {{ $message ?? '' }}
                @endif

                {{$assignments->links()}}

            </div>
        </div>
    </div>
</div>


@endsection