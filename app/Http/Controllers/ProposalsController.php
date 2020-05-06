<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Auth;
use App\Proposal;
use App\User;
use App\Assignment;
use App\Mail\NewProposal;
use Illuminate\Support\Facades\DB;


class ProposalsController extends Controller
{
    public function __construct()
    {
         $this->middleware ('auth');
    }

    public function showPostProposalPage($id)
    {

        $user = Auth::user();
        $assignment = Assignment::where('id',$id)->first();
        return view('freelancerPartials.postProposal', compact('user', 'assignment'));

    }

    public function create(Request $data)
    {

        //prompt if assignment already awarded or already applied.

        $proposal = Proposal::where('assignment_id', $data['assignmentId'])
                                ->where('user_id', $data['userId'])
                                ->first();

        if($proposal){ 

           session()->flash('message', 'You can only apply once.');
            return redirect()->route('assignment', ['id' => $data['assignmentId']]);

        } elseif (Proposal::where('assignment_id', $data['assignmentId'])->first()) {

           session()->flash('message', 'Project not available or awarded to someone else.');
           return redirect()->route('assignment', ['id' => $data['assignmentId']]);
           
        } else {
            Proposal::create([
                'user_id' => $data['userId'],
                'assignment_id' => $data['assignmentId'],
                'cover_letter' => $data['coverLetter'],
                'status' => $data['status']
                ]);

            // Send a mail to the client when user submits a proposal
    
            $user = User::where('id', $data['userId'])->first();
            $assignment = Assignment::where('id', $data['assignmentId'])->first();
        
            Mail::to(request('clientEmail'))
                ->send(new NewProposal($user,$assignment));
        
            return redirect(route('assignment', ['id' => $data['assignmentId']]));
        }
    }

    public function showSelectedProposal($id)
    {
        $proposal = Proposal::where('id', $id)->first();

        return view('clientPartials.selected-proposal', compact('proposal'));
    }

    //  Approve or Reject Proposal

    public function approve($assignmentId, $proposalId)
    {
        $proposal = Proposal::where('id', $proposalId)
                                ->update(['status' => 'Approved']);

        //    Change Assignment status after approving a proposal

        $assignment = Assignment::where('id',$assignmentId)
                                    ->update(['status' => 'In Progress']);

        return redirect()
                ->route('client.home');
    }

    public function reject($id)
    {
        $proposal = Proposal::where('id', $id)
                                ->update(['status' => 'Rejected']);

        return redirect()
                ->route('proposal', ['proposalId' => $id]);
    }
}
