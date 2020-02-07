<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Batch;
use App\Client;


class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:client');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $request = request();

        // Store files from uploads to public with specified name

        if ($request->hasFile('cv') || $request->hasFile('profileImg')) {
            $requestedProfileImage = $request->file('profileImg');
            $requestedCvImage = $request->file('cv');
            $time = time();

            $profileImage = $time . '-' . $requestedProfileImage->getClientOriginalName();
            $cv = $time . '-' . $requestedCvImage->getClientOriginalName();

            $profileImage = $requestedProfileImage->storeAs('uploads', $profileImage, 'public');
            $cv = $requestedProfileImage->storeAs('uploads', $cv, 'public');
        }

        return User::create([
            'batch_id' => $data['batch'],
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'profile_image_url' => $profileImage, // Store file path in database
            'cv_url' => $cv, // Store file path in database
            'competencies' => $data['cmpt'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function showRegistrationForm()
    {
        $batch = new Batch;
        $batch = $batch->all();

        return view('auth.register', compact('batch'));
    }

    // Client Registration

    public function showClientRegistrationForm()
    {
        return view('auth.clientRegister', ['url' => 'client']);
    }

    public function addClient(Request $data)
    {
        $this->validator($data->all())->validate(); // Validate requested credentials

        if ($data->hasFile('profileImg')) {
            $requestedProfileImage = $data->file('profileImg');
            $time = time();

            $profileImage = $time . '-' . $requestedProfileImage->getClientOriginalName();

            $profileImage = $requestedProfileImage->storeAs('uploads', $profileImage, 'public');
        }

        Client::create([
            'company_name' => $data['name'],
            'profile_image' => $profileImage,
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return redirect('/client/login');
    }
}
