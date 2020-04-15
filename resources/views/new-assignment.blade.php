@extends('layouts.app')

@section('content')

<style media="screen">
    #apply,#view
    {
        text-align: right;
        padding: 10px;
        border-radius: 13px;
        font-size: 1rem;
    }

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

    <div class="row justify-content-center mb-5">
        <div class="col-lg-9 col-sm-9">
            <div class="card">
                <div class="card-header"><h2>{{$assignment->title}}</h2></div>
                <div class="card-body">

                    <div class="container mt-3">
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

                    <div class="row container mt-3">
                        <div class="col-lg-4 col-sm-4">
                            <div class="container mt-5">
                                <h4>Target time:</h4>
                                <h5>{{$assignment->turn_around_time}} weeks</h5>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-4">
                            <div class="container mt-5">
                                <h4>Budget:</h4>
                                <h5>
                                    ${{$assignment->cost_low}} - ${{$assignment->cost_high}}
                                </h5>
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-4">
                            <div class="mt-5 container">

                                <ul class="">
                                    <h4>Skills required:</h4>
                                            @foreach($assignment->tagNames as $tag)
                                                <li class="tagList alert-secondary">
                                                    <a href="/home/search?{{$tag}}">{{$tag}}</a>
                                                </li>

                                            @endforeach
                                    <!-- </li> -->
                                </ul>

                            </div>
                        </div>
                    </div>

                    <div class="container mt-3 mb-5">
                        @auth('web')
                             <a
                               href="{{route('proposal.post', ['assignmentId' => $assignment->id])}}"
                               id="apply" class="btn btn-dark">
                               Apply for this job
                           </a>
                        @endauth

                        @auth('client')
                            <a
                               href="/assignment/{{$assignment->id}}/proposals"
                               class="btn btn-light border-dark" id="view">
                               View Proposals
                           </a>
                        @endauth
                    </div>

                </div>
            </div>
        </div>

        @auth('client')

            <div class="col-lg-3 col-sm-3">
                <div class="card">
                    <div class="card-header">
                        <h2>Proposals</h2>
                    </div>
                    <div class="card-body">

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

        @endauth

    </div>

@endsection
