<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Batch;
use App\Assignment;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web,admin')->except(['index', 'profile']);
    }

    public function show(Request $request)
    {
        $user = Auth::user();
        $assignments = Assignment::where('status', 'Pending Approval')
            ->orderBy('id', 'desc')->paginate(5);

        if (empty($request->all())) { // View all Assignments

            return view('freelancerPartials.freelancer', compact('assignments', 'user'));

        } elseif (!empty($request) && $request->has('search') && $request['search'] == '') { // If
            // search
            return view('freelancerPartials.freelancer', compact('assignments', 'user'));

        } elseif (!empty($request) && $request->has('search') && $request['search'] !== '') { //
            // Return search results
            $search = $request['search'];

            return view('freelancerPartials.freelancer', [
                'assignments' => Assignment::where(
                    'title',
                    'LIKE',
                    '%' . $search . '%'
                )
                    ->orWhere('company_name', 'LIKE', '%' . $search . '%')
                    ->orderBy('id', 'desc')
                    ->paginate(5),
                'user' => $user,
                'message' =>
                    'No assignments found with title "' . $search . '".',
                'showingResultsFor' => 'Showing results for "' . $search . '".',
            ]);

        } elseif (!empty($request) && $request->has('min') && $request['min'] == '' && $request['max'] == '') { // Return price results

            return view('freelancerPartials.freelancer', compact('assignments', 'user'));

        } elseif (!empty($request) && $request->has('min') || $request->has('max') && $request['min']
            !== ''
            ||
            $request['max'] !== '') {
            $min = $request['min'];
            $max = $request['max'];

            return view('freelancerPartials.freelancer', [
                'assignments' => Assignment::WhereBetween('cost_high', [
                    $min,
                    $max,
                ])
                    ->orderBy('id', 'desc')
                    ->paginate(5),
                'user' => $user,
                'message' => 'No assignments found at this cost range',
                'showingResultsFor' =>
                    'Showing results for projects under "' .
                    $min .
                    ' - ' .
                    $max .
                    '".',
            ]);
        }
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        // View all Assignments

        if (empty($request->all())) {
            return view('index', [
                'assignments' => Assignment::orderBy('id', 'desc')->paginate(5),
                'user' => $user,
            ]);
        } // if blank search then view all assignment
        elseif ($request['search'] == '') {
            return view('index', [
                'assignments' => Assignment::latest()->paginate(5),
                'user' => $user,
            ]);
        } // Return search results
        else {
            $search = $request['search'];

            return view('index', [
                'assignments' => Assignment::where(
                    'title',
                    'LIKE',
                    '%' . $search . '%'
                )
                    ->orWhere('company_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('tags', 'LIKE', '%' . $search . '%')
                    ->orderBy('id', 'desc')
                    ->paginate(5),
                'user' => $user,
                'message' =>
                    'No assignments found with title "' . $search . '".',
                'showingResultsFor' => 'Showing results for "' . $search . '".',
            ]);
        }
    }

    public function profile($id)
    {
        $user = User::where('id', $id)->firstOrFail();

        $approved = \App\Proposal::where('user_id', $user->id)
            ->where('status', 'Approved')
            ->get();

        $completed = \App\Proposal::where('user_id', $user->id)
            ->where('status', 'completed')
            ->get();

        return view(
            'freelancerPartials.freelancer-profile',
            compact('user', 'approved', 'completed')
        );
    }

    public function showEditPage(User $user)
    {
        $batch = Batch::get();
        return view('freelancerPartials.update', compact('user', 'batch'));
    }

    public function update(User $user)
    {
        if (request()->hasFile('cv') || request()->hasFile('profileImage')) {

            $profileImage = $user->saveImageWithNameInPublicPath(request('profileImage'));
            $cv = $user->saveImageWithNameInPublicPath(request('cv'));

        } else {
            $profileImage = null;
            $cv = null;
        }

        $user->update([
            'batch_id' => request('batch'),
            'name' => request('name'),
            'email' => request('email'),
            'phone' => request('phone'),
            'profile_image_url' => $profileImage, // Store file path in database
            'cv_url' => $cv, // Store file path in database
            'competencies' => request('competencies'),
            'password' => bcrypt(request('password')),
        ]);

        return redirect(route('freelancer.profile', ['user' => $user->id]));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/home');
    }
}
