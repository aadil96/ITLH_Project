@extends('layouts.app')

@section('title')
	Proposals
@endsection

@section('content')

	<div class="container mb-5">
		<h1>Proposals</h1>
	</div>


	@if($proposals->count() > 0)	

		<table class="table">

            @foreach($proposals as $proposal)

                <thead>
                    <th id="heading">{{ $proposal->user->name }}</th>
                </thead>

                <tbody>

                <tr>
                    <td>{{ substr($proposal->cover_letter, 0, 100) }} <a class="d-block text-right" href="/proposal/{{ $proposal->id }}">More details</a></td>
                </tr>

                </tbody>
            @endforeach

        </table>

	@endif 

@endsection