<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Assignment;
use Conner\Tagging\Model\Tag;
use App\Client;
use Faker\Provider\ar_JO\Company;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:client');
    }

    public function index(Request $request)
    {
        $client = Client::where(
            'id',
            Auth::user()->id
        )->firstOrFail();

        if (empty($request->all())) // View all Assignments
        {
            if ($client->assignments->count() > 0) {
                return view(
                    'clientPartials.client',
                    [
                        'client' => $client,
                        'assignments' => Assignment::where('client_id', $client->id)
                            ->where('status', 'Pending Approval')
                            ->orderBy('id', 'desc')
                            ->paginate(5)
                    ]
                );
            } elseif ($client->assignments->count() === 0) {

                $message = 'No jobs posted yet';

                return view('clientPartials.client', compact('client', 'message'));
            }
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
                        ->where('title', 'LIKE', '%' . $search . '%')
                        ->orWhere('company_name', 'LIKE', '%' . $search . '%')
                        ->orWhere('tags', 'LIKE', '%' . $search . '%')
                        ->orderBy('id', 'desc')
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
