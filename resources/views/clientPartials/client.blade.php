@extends('layouts.app')

@section('content')

    <style type="text/css">
        #heading {
            font-size: 1.5rem;
        }
    </style>

    <div class="row">
        <div class="col-3">
            <div class="border rounded">
                <h2 class="container border-bottom">Tags</h2>

                <div class="alert">
                    <ul>
                        <!-- <li> -->
                            @foreach($assignments as $assignment)
                                @foreach($assignment->tagNames as $tag)
                                    <li>
                                        {{$tag}}
                                    </li>

                                @endforeach
                            @endforeach
                        <!-- </li> -->
                    </ul>
                </div>

            </div>
        </div>

        <div class="col-6">
            <form action="/client/home" method="get" role="search">
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

    <a id="post" class="btn btn-dark ml-3 mt-3 mb-5" href="/post/assignment">Post Assignment</a>
    <br>
    
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

        <div class="col-3">
            
        </div>
    </div>


    

    <script type="text/javascript">

        var data = document.querySelector('#search').value;

        $.ajax({
            url =
        })

    </script>

@endsection
