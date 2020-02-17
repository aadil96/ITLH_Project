<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // dd(Auth::user());
        if(empty($request->all())) // View all Assignments
        {
            return view('freelancer', [
                'assignments' => Assignment::orderBy('id', 'desc')->paginate(5),
                'user' => Auth::user(),
            ]);
        }



        elseif ($request['search'] == '') // if blank search then view all assignment
        {
            return view('freelancer', [
                'assignments' => Assignment::latest()->paginate(5),
                'user' => Auth::user(),
            ]);
        }



        
        else // Return search results
        {
            $search = $request['search'];

            return view('freelancer', [
                'assignments' => Assignment::where('title', 'LIKE', '%' . $search . '%')
                                                ->orWhere('company_name', 'LIKE', '%' . $search . '%')
                                                ->orderBy('id', 'desc')
                                                ->paginate(5),
                'user' => Auth::user(),
                'message' => 'No assignments found with title "' .$search. '"',
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
