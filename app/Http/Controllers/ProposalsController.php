<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Auth;
use App\Proposal;
use App\User;
use App\Assignment;

class ProposalsController extends Controller
{
    public function __construct()
    {
         $this->middleware ('auth');
    }

    public function show($id)
    {
        $user = Auth::user();
        $assignment = Assignment::where('id',$id)->first();
        return view('postProposal', compact('user', 'assignment'));
    }
    
    public function create(Request $data)
    {
        Proposal::create([
            'user_id' => $data['userId'],
            'assignment_id' => $data['assignmentId'],
            'cover_letter' => $data['coverLetter'],
            'status' => $data['status']
            ]);
        
    // Send a mail to the client when user submits a proposal
        
        /*
        Mail::to(request('clientEmail'))
            ->send(new ProposalEmail());
            */
            
        return redirect(route('home'));
    }
}
