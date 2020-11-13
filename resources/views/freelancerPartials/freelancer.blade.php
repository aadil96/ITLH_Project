@extends('layouts.app')

@section('navbar-links')
@include('includes.freelancer-nav-links')
@endsection
@section('content')

<style type="text/css">
    .tagList {
        /*background-color: gray;*/
        display: inline-block;
        width: max-content;
        margin-right: 3px;
        list-style-type: none;
        /*border: 2px solid gray;*/
        border-radius: 5px;
        padding: 5px;
        font-size: 0.8rem;
    }

    @media (min-width: 770px){
        .banner{
            background-image: url({{ asset('bg-images/banner2.jpg') }});
            background-repeat: no-repeat;
            background-size: cover;
            width: 100%;
            height: 400px;
        }
    }
</style>

<div class="row justify-content-center">
    <div class="col-lg-10 col-sm-10">
        <div class="card mb-5">
            <div class="card-header">Feed</div>
            <div class="card-body">

                @if(Session::has('welcomeMsg'))
                @php
                    $msg = Session::get('welcomeMsg')
                @endphp
                    <div id="root">
                        <welcome-message :title="'{{ $msg['title'] }}'" :body="'{{ $msg['body'] }}'"></welcome-message>
                    </div>
                @endif


                <div class="banner" style="">
{{--                    <img src="{{ asset('bg-images/banner2.jpg') }}" alt="">--}}
                </div>

                <form class="form-group mt-3" action="?" method="get">
                    <div class="col-10 d-inline-flex">
                        <label for="searchInput"></label>
                        <input id="searchInput" type="text" class="form-control mr-2" name="search" placeholder="Search job by company name or title" autofocus>
                        <span class="form-group-btn">
                            <button type="submit" class="btn btn-outline-dark">
                                <span class="fa fa-search"></span>
                            </button>
                        </span>
                    </div>
                </form>

                {{-- price filter  --}}
                <div class="ml-3 d-flex-inline">
                    <form action="?" method="GET" class="form-inline">

                        <p class="mr-2 mt-3 align-bottom">Filter by cost: </p>

                        <label for="min" class="mr-2">min</label>
                        <input type="text" class="form-control form-control-sm mr-2" name="min" id="min">

                        <label for="max" class="mr-2">max</label>
                        <input type="text" id="max" class="form-control form-control-sm mr-2" name="max">

                        <span class="form-group-btn">
                            <button type="submit" class="btn p-1 btn-outline-dark">
                                <span class="fa fa-search p-1"></span>
                            </button>
                        </span>
                    </form>
                </div>
                <!-- Assignments -->

                <div class="mt-4">

                    @if ( $assignments->count() > 0 )

                    <table class="table">

                        <thead>
                            <th style="align-content: center;">Title</th>
                            <th>Description</th>
                            <th>Tags</th>
                        </thead>

                        @foreach ( $assignments as $assignment )
                        <tr>
                            <td>{{ $assignment->title }}</td>
                            <td>{{ Str::limit($assignment->description, 50, '...') }}</td>
                            <td>
                                @foreach ( $assignment->tags as $tag )
                                <a class=" tagList alert-secondary" href="?search={{$tag->slug}}">{{ $tag->name }}
                                </a>
                                @endforeach
                            </td>
                            <td>
                                <a class="d-block text-right" href="/assignment/{{ $assignment->id }}">
                                    view more
                                </a>
                            </td>
                        </tr>
                        @endforeach

                    </table>

                    <!-- Assignment end -->

                    @else
                    {{ $message ?? ''}}
                    @endif

                    {{ $assignments->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
