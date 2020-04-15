<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Assignment;
use App\Proposal;

class AssignmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:client')->except('show');
        // $this->middleware('auth:web');
    }

    public function showPostAssignmentPage()
    {
        return view('clientPartials.postAssignment');
    }

    public function addAssignment(Request $data)
    {

        $data->validate([
            'title' => ['required', 'max:125'],
            'description' => ['required'],
            'tat' =>['numeric'],
            'costLow' => ['numeric'],
            'costHigh' => ['numeric'],
            'tag' => ['min:3', 'max:12']
        ]);

        if ($data->hasFile('specs'))  // This will blow up if 'entcrpt=multi/data' is not specified in form
        {
            $requestedDocument = $data->file('specs');
            $time = time();

            $spec = $time . '-' . $requestedDocument->getClientOriginalName();

            $spec = $requestedDocument->storeAs('uploads', $spec, 'public');

            $tags = explode(',', $data['tag']); // Separates tags

            $assignments = Assignment::create([
                                        'client_id' => Auth::id(),
                                        'title' => $data['title'],
                                        'description' => $data['dscrpt'],
                                        'specification_document_url' => $spec,
                                        'turn_around_time' => $data['tat'],
                                        'company_name' => $data['cmpny'],
                                        'cost_low' => $data['costLow'],
                                        'cost_high' => $data['costHigh'],
                                        'tags' => $data['tag'],
                                        'status' => $data['status'],
        ]);

        $assignments->tag($tags);
        }
        elseif (!$data->hasFile('specs'))
        {
            $tags = explode(',', $data['tag']);

            $assignments = Assignment::create([
                            'client_id' => Auth::id(),
                            'title' => $data['title'],
                            'description' => $data['dscrpt'],
                            'turn_around_time' => $data['tat'],
                            'company_name' => $data['cmpny'],
                            'cost_low' => $data['costLow'],
                            'cost_high' => $data['costHigh'],
                            'tags' => $data['tag'],
            ]);

            $assignments->tag($tags);
        }

        return redirect('/client/home');
    }

    public function show($id)
    {
        $assignment = Assignment::where('id', $id)->with('tagged')->firstOrFail();

        $proposals = Proposal::where('assignment_id', $id)->get();

        return view('new-assignment', compact('assignment', 'proposals'));
    }
}
