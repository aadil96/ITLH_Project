@extends('layouts.app')

@section('navbar-links')
@include('includes.freelancer-nav-links')
@endsection

@section('content')

<style type="text/css">
    #heading {
        font-size: 1.5rem;
    }

    .tagList {
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

                <!-- Seacrh Bar -->

                <form class="form-group mt-3" action="/home" method="get" role="search">
                    {{ csrf_field() }}

                    <div class="col-10 d-inline-flex">
                        <input id="searchInput" type="text" class="form-control mr-2" name="search"
                            placeholder="Search job by company name or title">
                        <span class="form-group-btn">
                            <button type="submit" class="btn btn-outline-dark">
                                <span class="fa fa-search"></span>
                            </button>
                        </span>
                    </div>
                </form>
                <br>

                <!-- Assignments -->

                <div class="">

                    @if($assignments->count() > 0)

                    <table class="table">

                        @foreach($assignments as $assignment)

                        <thead>
                            <th id="heading">{{ $assignment->title }}</th>
                        </thead>

                        <tbody>

                            <tr>
                                <td>{{ substr($assignment->description, 0, 100) }} <a class="d-block text-right"
                                        href="/assignment/{{ $assignment->id }}">view more</a></td>
                            </tr>

                        </tbody>
                        @endforeach

                    </table>

                    <!-- Assignment end -->

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