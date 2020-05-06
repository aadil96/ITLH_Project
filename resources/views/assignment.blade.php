@extends('layouts.app')

@section('navbar-links')

    <ul class="navbar-nav ml-auto">
        <li class="nav-item ml-auto">
            <a class="navbar-text nav-link" href="{{route('client.profile', ['id', Auth::user()->id])}}">Profile</a>
        </li>
        <li class="nav-item ml-auto">
            <a class="navbar-text nav-link" href="{{route('client.logout')}}">Logout</a>
        </li>
    </ul>

@endsection

@section('content')

<style type="text/css">
    .tagList
    {
        /*background-color: gray;*/
        display: inline-block;
        width: max-content;
        margin: 5px;
        /*border: 2px solid gray;*/
        border-radius: 5px;
        padding: 5px;
    }
</style>

    <div class="row">
        <div class="col-8">

            <div class="container">
                <h2>{{$assignment->title}}</h2>
            </div>

            <div class="container mt-5">
                <img
                    src="/storage/{{$assignment->specification_document_url}}"
                    height="300"
                    width="300"
                    alt="! No specification document uploaded">
            </div>

            <div class="container mt-5">
                <h4>Details:</h4>
                <h5>{{$assignment->description}}</h5>
            </div>

            <div class="row">
                <div class="col-4">

                    <div class="container mt-5">
                        <h4>Target time:</h4>
                        <h5>{{$assignment->turn_around_time}} weeks</h5>
                    </div>

                </div>

                <div class="col-4">

                    <div class="container mt-5">
                        <h4>Budget:</h4>
                        <h5>
                            ${{$assignment->cost_low}} - ${{$assignment->cost_high}}
                        </h5>
                    </div>

                </div>

                <div class="col-4">
                    <div class="mt-5 container">

                        <ul class="">
                            <h4>Skills required:</h4>
                            <!-- <li> -->
                                    @foreach($assignment->tagNames as $tag)
                                        <li class="tagList alert-secondary">
                                            {{$tag}}
                                        </li>

                                    @endforeach
                            <!-- </li> -->
                        </ul>

                    </div>
                </div>

            </div>

        </div>

        @auth('client')
            <div class="col-4">
                <div class="border-left">
                    <h2 class="container">Proposals</h2>
                        @if($proposals->count() > 0)

                            <table class="table mt-3">

                                 @foreach($proposals as $proposal)

                                    <thead>
                                        <th id="heading">{{ $proposal->user->name }}</th>
                                    </thead>

                                    <tbody>

                                        <tr>
                                            <td>
                                                {{ substr($proposal->cover_letter, 0, 100) }}
                                                <a
                                                    class="d-block text-right"
                                                    href="/proposal/{{ $proposal->id }}">
                                                    view more
                                                </a>
                                            </td>
                                        </tr>

                                    </tbody>
                                @endforeach

                            </table>

                        @else
                            {{$message ?? '' ?? ''}}
                        @endif

                </div>
            </div>
        @endauth

    </div>

     <br>
     <br>

     @auth('web')
          <a
            href="/assignment/{{$assignment->id}}/proposal/post">
            Apply for this job
        </a>
     @endauth

     @auth('client')
         <a
            href="/assignment/{{$assignment->id}}/proposals">
            View Proposals
        </a>
     @endauth

@endsection
