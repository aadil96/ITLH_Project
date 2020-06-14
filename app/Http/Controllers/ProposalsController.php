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
        $this->middleware('auth');
    }

    public function showPostProposalPage(Assignment $assignment)
    {
        $user = Auth::user();
        return view(
            'freelancerPartials.postProposal',
            compact('user', 'assignment')
        );
    }

    public function create(Request $data)
    { //prompt if assignment already awarded or already applied.

        $alreadyApplied = Proposal::where(
            'assignment_id',
            $data['assignmentId']
        )
            ->where('user_id', $data['userId'])
            ->first();

        $awardedToSomeone = Proposal::where('assignment_id', $data['assignmentId'])
            ->where('status', 'Approved')
            ->first();

        if ($alreadyApplied) {
            session()->flash('message', 'You can only apply once.');
            return redirect()->route('assignment', [
                'id' => $data['assignmentId'],
            ]);
        } elseif ($awardedToSomeone) {
            session()->flash(
                'message',
                'Project not available or awarded to someone else.'
            );
            return redirect()->route('assignment', [
                'id' => $data['assignmentId'],
            ]);
        } else {
            Proposal::create([
                'user_id' => $data['userId'],
                'assignment_id' => $data['assignmentId'],
                'cover_letter' => $data['coverLetter'],
                'status' => $data['status'],
            ]);

            // Send a mail to the client when user submits a proposal

            $user = User::where('id', $data['userId'])->first();
            $assignment = Assignment::where(
                'id',
                $data['assignmentId']
            )->first();

            Mail::to(request('clientEmail'))->send(
                new NewProposal($user, $assignment)
            );

            return redirect(
                route('assignment', ['id' => $data['assignmentId']])
            );
        }
    }

    public function showSelectedProposal(User $user, Proposal $proposal)
    {
        return view(
            'clientPartials.selected-proposal',
            compact('proposal', 'user')
        );
    }

    //  Approve or Reject Proposal

    public function approve(Assignment $assignment, Proposal $proposal)
    {
        \DB::table('assignments')->where('id', $assignment->id)
            ->update(['status' => 'In Progress']);
        $proposal->update(['status' => 'Approved']);

        //    Change Assignment status after approving a proposal

        Proposal::where('status', 'Pending Approval')->update([
            'status' => 'Rejected',
        ]);

        $usersRejected = Proposal::where('status', 'Rejected')->get();

        foreach ($usersRejected as $rejected) {
            Mail::to($rejected->user->email)->send(new \App\Mail\Rejected());
        }

        Mail::to($proposal->user->email)->send(new \App\Mail\Approved());

        return redirect()->route('client.home');
    }

    public function reject(Assignment $assignment, Proposal $proposal)
    {
        $proposal->update([
            'status' => 'Rejected',
        ]);

        Mail::to($proposal->user->email)->send(new \App\Mail\Rejected());

        return redirect()->route('proposal', [
            'user' => $proposal->user->id,
            'proposal' => $proposal->id,
        ]);
    }
}
