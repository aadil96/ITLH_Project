<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Assignment;
use App\Proposal;

class AssignmentsController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:client');
    //     // $this->middleware('auth');
    // }

    public function showPostAssignmentPage()
    {
        // dd(Auth::user());
        // dd('post assignment');
        return view('clientPartials.postAssignment');
    }

    public function addAssignment(Request $data)
    {

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

        $assignment = Assignment::where('id', $id)->with('tagged')->first();

        $proposals = Proposal::where('assignment_id', $id)->get();

        return view('assignment', compact('assignment', 'proposals'));
    }
}
