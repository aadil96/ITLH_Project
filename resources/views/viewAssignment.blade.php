@extends('layouts.app')

@section('content')


        {{$assignment->id}}

	{{$assignment->description}}


         <br>
         <br>


         @auth('web')
              <a href="/{{$assignment->id}}/post/proposal">Apply for this job</a>
         @endauth


         @auth('client')
             <a href="/proposals">View Proposals</a>
         @endauth

@endsection