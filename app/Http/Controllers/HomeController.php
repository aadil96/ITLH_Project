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
        $this->middleware('auth');
        // $this->middleware('auth:client');
    }

    public function index(Request $request)
    {
        if(empty($request->all())) // View all Assignments
        {
            return view('freelancerPartials.freelancer', [
                'assignments' => Assignment::orderBy('id', 'desc')->paginate(5),
                'user' => Auth::user(),
                'tags' => Tag::all(),
            ]);
        }
        elseif ($request['search'] == '') // if blank search then view all assignment
        {
            return view('freelancerPartials.freelancer', [
                'assignments' => Assignment::latest()->paginate(5),
                'user' => Auth::user(),
                'tags' => Tag::all(),
            ]);
        }
        else // Return search results
        {
            $search = $request['search'];

            return view('freelancerPartials.freelancer', [
                'assignments' => Assignment::where('title', 'LIKE', '%' . $search . '%')
                                                ->orWhere('company_name', 'LIKE', '%' . $search . '%')
                                                ->orderBy('id', 'desc')
                                                ->paginate(5),
                'user' => Auth::user(),
                'message' => 'No assignments found with title "' .$search. '"',
                'tags' => Tag::all(),
            ]);
        }
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
