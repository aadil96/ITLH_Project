@extends('layouts.app')

@section('content')

    <style type="text/css">
        #heading {
            font-size: 1.5rem;
        }
    </style>

    {{$user->batch->name}}

    <!-- Seacrh Bar -->

    <form action="/home" method="get" role="search">
        {{ csrf_field() }}
        <div class="input-group">
            <input type="text" class="form-control mr-2" name="search"
                   placeholder="Search users"> <span class="input-group-btn">
                    <button type="submit" class="btn btn-outline-dark">
                        <span class="fa fa-search"></span>
                    </button>
                </span>
        </div>
    </form>
    <br>

    <!-- Dashboard -->

    <div class="container">

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

@endsection
