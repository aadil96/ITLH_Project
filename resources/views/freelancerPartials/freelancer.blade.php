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
		margin-right: 3px;
		list-style-type: none;
		/*border: 2px solid gray;*/
		border-radius: 5px;
		padding: 5px;
		font-size: 0.8rem;
	}
</style>

<div class="row justify-content-center">

	<div class="col-lg-10 col-sm-10">
		<div class="card mb-5">
			<div class="card-header">Feed</div>
			<div class="card-body">

				<!-- Seacrh Bar -->
				<form class="form-group mt-3" action="/home" method="get">
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

				{{--  price filter  --}}
				<div class="ml-3 d-flex-inline">
					<form action="/home" method="GET" class="form-inline">

						<p class="mr-2 mt-3 align-bottom">Filter by cost: </p>

						<label class="mr-2" for="min">min</label>
						<input type="text" class="form-control form-control-sm mr-2" name="min" id="">

						<label class="mr-2" for="max">max</label>
						<input type="text" class="form-control form-control-sm mr-2" name="max">

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
							<th align="center">Title</th>
							<th>Description</th>
							<th>Tags</th>
						</thead>

						@foreach ( $assignments->where('status', 'Pending Approval') as $assignment )
						<tr>
							<td>{{ $assignment->title }}</td>
							<td>{{ Str::limit($assignment->description, 50, '...') }}</td>
							<td>
								@foreach ( $assignment->tags as $tag )
								<a class=" tagList alert-secondary" href="/home?search={{$tag->slug}}">{{ $tag->name }}
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
					{{ $message ?? '' ?? '' }}
					@endif

					{{ $assignments->links() }}

				</div>
			</div>
		</div>
	</div>
</div>
</div>

@endsection