<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Assignment;
use Conner\Tagging\Model\Tag;
use DB;
use App\Client;

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
            return view('clientPartials.client',
            [
                'assignments' => Assignment::where('status', 'Pending Approval')
                                                        ->orderBy('id', 'desc')
                                                        ->paginate(5),
                'user' => Auth::user(),
                'tags' => Tag::all(),
            ]);
        }
        elseif ($request['search'] == '') // if blank search then view all assignment
        {
            return view('clientPartials.client',
                            [
                                'assignments' => Assignment::latest()
                                                        ->paginate(5),
                                'user' => Auth::user(),
                                'tags' => Tag::all(),
                            ]);
        }
        else // Return search results
        {
            $search = $request['search'];

            return view('clientPartials.client',
            [
                'assignments' => Assignment::where('title', 'LIKE', '%' . $search . '%')
                                                ->orWhere('company_name', 'LIKE', '%' . $search . '%')
                                                ->orWhere('tags', 'LIKE', '%'. $search . '%')
                                                ->orderBy('id', 'desc')
                                                ->paginate(5),
                'user' => Auth::user(),
                'message' => 'No assignments found with title "' .$search. '"',
                'tags' => Tag::all(),
            ]);
        }

    }

    public function profile($id)
    {
        $client = Client::where('id', $id)->firstOrFail();

        $assignment = Assignment::all();

        $approved = Assignment::where('status', 'In Progress')->get();

        return view('client-profile', compact('client', 'assignment', 'approved'));
    }

    public function editProfilePage($id)
    {
        $client = Client::where('id', $id)->firstOrFail();

        return view('clientPartials.update', compact('client'));
    }

    public function edit(Request $request)
    {
        Client::where('id', $request['id'])->update([
            'company_name' => $request['company_name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password'])
        ]);

        return redirect(route('client.profile', ['id' => $request['id']]));
    }

    public function logout()
    {
        if (Auth::guard('client'))
        {
            Auth::logout();
            return redirect(route('client.login'));
        }
    }

}
