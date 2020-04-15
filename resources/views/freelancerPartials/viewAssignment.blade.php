@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-9">

            <div class="container">
                <h2>{{$assignment->title}}</h2>
            </div>

            <div class="container mt-5">
                <img
                    src="/storage/{{$assignment->specification_document_url}}"
                    height="300"
                    width="300"
                    alt="">
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
            </div>

        </div>

        <div class="col-3">

            <div class="container border-left">
                <h1 class="d-flex justify-content-center">Proposals</h1>

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

    </div>

         <br>
         <br>

         @auth('web')
              <a
                href="/assignment/{{$assignment->id}}/post/proposal">
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
