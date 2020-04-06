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

    public function showPostProposalPage($id)
    {
        $user = Auth::user();
        $assignment = Assignment::where('id',$id)->first();
        return view('freelancerPartials.postProposal', compact('user', 'assignment'));
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

    public function ProposalsPage($id)
    {
        $proposals = Proposal::where('assignment_id', $id)->get();

        return view('clientPartials.show-proposals', compact('proposals'));
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
