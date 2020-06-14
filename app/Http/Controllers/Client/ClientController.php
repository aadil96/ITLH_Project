<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Assignment;
use App\Client;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:client,admin');
    }

    public function index(Request $request)
    {
        $client = Client::where(
            'id',
            Auth::user()->id
        )->firstOrFail();

        if (empty($request->all())) // View all Assignments
        {
            $assignments = Assignment::where('client_id', $client->id)
                ->where('status', 'Pending Approval')
                ->orderBy('id', 'desc')
                ->paginate(5);

            return view(
                'clientPartials.client',
                [
                    'client' => $client,
                    'assignments' => $assignments,
                    'message' => 'No jobs posted yet.',

                ]
            );
        } elseif ($request['search'] == '') // if blank search then view all assignment
        {
            return view(
                'clientPartials.client',
                [
                    'client' => $client,
                    'assignments' => Assignment::where('client_id', $client->id)
                        ->latest()
                        ->paginate(5)
                ]
            );
        } else // Return search results
        {
            $search = $request['search'];

            return view(
                'clientPartials.client',
                [
                    'client' => $client,
                    'assignments' => Assignment::where('client_id', $client->id)
                        ->where('title', 'LIKE', '%' .
                            $search .
                            '%')
                        ->orWhere('client_id', $client->id)
                        ->where('tags', 'LIKE', '%' .
                            $search .
                            '%')
                        ->latest()
                        ->paginate(5),
                    'message' => 'No jobs found with term "' . $search . '"',
                ]
            );
        }
    }

    public function profile(Client $client)
    {
        $assignment = Assignment::where('client_id', $client->id)->get();

        $approved = Assignment::where('status', 'In Progress')
            ->where('client_id', $client->id)
            ->get();

        return view(
            'clientPartials.client-profile',
            compact('client', 'assignment', 'approved')
        );
    }

    public function editProfilePage(Client $client)
    {
        return view('clientPartials.update', compact('client'));
    }

    public function edit(Client $client)
    {
        $client->where('id', $client->id)->update([
            'company_name' => request('company_name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);

        return redirect()->route('client.profile', ['client' => $client->id]);
    }

    public function logout()
    {
        if (Auth::guard('client')) {
            Auth::logout();
            return redirect(route('client.login'));
        }
    }
}
