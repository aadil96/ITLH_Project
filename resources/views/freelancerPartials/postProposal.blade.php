 @extends('layouts.app')



    @section('content')

        <h2>Submit Proposal</h2>

            {{$user->id}}<br>
            {{$assignment->client->email}}

        <form action="/assignment/{{$assignment->id}}/proposal/post"  method="post" class='form-group'>
            @csrf

            <label for='coverLetter'>Cover Letter</label>

            <input name='coverLetter' class="form-control" type="text">

            <input name='userId' class="form-control" type="hidden" value="{{$user->id}}">

            <input name='assignmentId' class="form-control" type="hidden" value="{{$assignment->id}}">

            <input name='clientEmail' class="form-control" type="hidden" value="{{$assignment->client->email}}">

            <input name='status' class="form-control" type="hidden" value="Pending Approval">

            <br>
            <button class='btn btn-primary' type='submit'>Submit</button>
        </form>


    @endsection
