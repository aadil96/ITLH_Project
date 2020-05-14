<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Assignment;
use App\Proposal;
use App\Client;

class AssignmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:client')->except('show');
    }

    public function showPostAssignmentPage()
    {
        return view('clientPartials.postAssignment');
    }

    public function addAssignment(Client $client)
    {
        $client->validateAndCreateAssignment(request()->all());

        return redirect(route('client.home'));
    }

    public function show($id)
    {
        $assignment = Assignment::where('id', $id)->with('tagged')->firstOrFail();

        $proposals = Proposal::where('assignment_id', $id)->get();

        $message = 'No proposals yet.';

        return view('new-assignment', compact('assignment', 'proposals', 'message'));
    }
}
