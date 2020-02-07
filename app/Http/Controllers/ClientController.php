<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Assignment;
use DB;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:client');
    }

    public function index(Request $request)
    {

        if(empty($request->all())) // View all Assignments
        {
            return view('client', [
                'assignments' => Assignment::orderBy('id', 'desc')->paginate(5),
                'user' => Auth::user(),
            ]);
        }



        elseif ($request['search'] == '') // if blank search then view all assignment
        {
            return view('client', [
                'assignments' => Assignment::latest()->paginate(5),
                'user' => Auth::user(),
            ]);
        }



        
        else // Return search results
        {
            $search = $request['search'];

            return view('client', [
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
        if (Auth::guard('client')) {
            Auth::logout();
            return redirect('/');
        }
    }

}
