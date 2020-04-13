@extends('layouts.app')

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

    <!-- <div class="row">
        <div class="col-2">
            <div class="border rounded">
                <h2 class="container">Tags</h2>

                <div>
                    <a href="">Company name</a>
                </div>
            </div>

        </div> -->

        <div class="row justify-content-center">

            <div class="col-lg-2 col-sm-2 pl-0 pr-0 mr-5">
            <div class="card">
                <div class="card-header">Tags</div>

                <div class="body">
                    <ul style="padding: 0px;">
                        <!-- <li> -->
                            @foreach($tags as $tag)
                                <li class="tagList alert-secondary">
                                    <a href="home?search={{$tag->name}}">{{$tag->name}}</a>
                                </li>
                            @endforeach
                        <!-- </li> -->
                    </ul>
                </div>

            </div>
        </div>

            <div class="col-lg-8 col-sm-8">
                <div class="card">
                    <div class="card-header">Feed</div>
                    <div class="card-body">
                        <!-- Seacrh Bar -->

                        <form action="/home" method="get" role="search">
                            {{ csrf_field() }}
                            <div class="input-group">
                                <input type="text" class="form-control mr-2" name="search"
                                       placeholder="Search job by company name or title"> <span class="input-group-btn">
                                        <button type="submit" class="btn btn-outline-dark">
                                            <span class="fa fa-search"></span>
                                        </button>
                                    </span>
                            </div>
                        </form>
                        <br>

                        <!-- Dashboard -->

                    <div class="">

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

                        @else
                            {{$message ?? '' ?? ''}}
                        @endif

                        {{$assignments->links()}}

                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
