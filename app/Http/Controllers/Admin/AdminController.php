<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function show()
    {
        $admin = Auth::user();

        $users = \App\User::latest()->paginate(5);

        $clients = \App\Client::latest()->paginate(5);

        $assignments = \App\Assignment::latest()->paginate(5);

        return view('admin-home', compact('admin', 'users', 'clients', 'assignments'));
    }

    public function addBatch(Request $request)
    {
        $batch = \App\Batch::create([
            'name' => $request['batchYear'],
        ]);

        return redirect()->back();
    }

    public function destroyAssignment(\App\Assignment $assignment)
    {
        $assignment->delete();
    }

    public function destroyClient(\App\Client $client)
    {
        $client->delete();

        return redirect()->back();
    }

    public function destroyUser(\App\User $user)
    {
        $user->delete();

        return redirect()->back();
    }

    public function logout()
    {
        if (Auth::guard('admin')) {
            Auth::logout();
            return redirect(route('admin.login'));
        }
    }
}
