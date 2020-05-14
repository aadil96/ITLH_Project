<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Conner\Tagging\Model\Tag;
use App\User;
use App\Client;
use App\Batch;
use App\Assignment;

class HomeController extends Controller
{
    // *
    //  * Create a new controller instance.
    //  *
    //  * public function index()
    //  * {
    //  * return view('home');
    //  * }
    //  *
    //  * @return void
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'profile']);
    }

    public function show(Request $request)
    {
        $user = Auth::user();

        if (empty($request->all())) // View all Assignments
        {
            return view('freelancerPartials.freelancer', [
                'assignments' => Assignment::orderBy('id', 'desc')->paginate(5),
                'user' => $user,
            ]);
        } elseif ($request['search'] == '') // if blank search then view all assignment
        {
            return view('freelancerPartials.freelancer', [
                'assignments' => Assignment::latest()->paginate(5),
                'user' => $user,
            ]);
        } else // Return search results
        {
            $search = $request['search'];

            return view('freelancerPartials.freelancer', [
                'assignments' => Assignment::where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('company_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('tags', 'LIKE', '%' . $search . '%')
                    ->orderBy('id', 'desc')
                    ->paginate(5),
                'user' => $user,
                'message' => 'No assignments found with title "' . $search . '".',
                'showingResultsFor' => 'Showing results for "' . $search . '".',
            ]);
        }
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        if (empty($request->all())) // View all Assignments
        {
            return view('index', [
                'assignments' => Assignment::orderBy('id', 'desc')->paginate(5),
                'user' => $user,
            ]);
        } elseif ($request['search'] == '') // if blank search then view all assignment
        {
            return view('index', [
                'assignments' => Assignment::latest()->paginate(5),
                'user' => $user,
            ]);
        } else // Return search results
        {
            $search = $request['search'];

            return view('index', [
                'assignments' => Assignment::where('title', 'LIKE', '%' . $search . '%')
                    ->orWhere('company_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('tags', 'LIKE', '%' . $search . '%')
                    ->orderBy('id', 'desc')
                    ->paginate(5),
                'user' => $user,
                'message' => 'No assignments found with title "' . $search . '".',
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

        return view('freelancerPartials.freelancer-profile', compact('user', 'approved', 'completed'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
}
