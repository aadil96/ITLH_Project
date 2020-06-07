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
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        $user = new User();

        if (request()->hasFile('cv') || request()->hasFile('profileImg')) {

            $profileImage = $user->saveImageWithNameInPublicPath(request('cv'));

            $cv = $user->saveImageWithNameInPublicPath(request('profileImg'));

        } else {
            $profileImage = null;
            $cv = null;
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
        $batch = Batch::get();

        return view('auth.register', compact('batch'));
    }

    // Client Registration

    public function showClientRegistrationForm()
    {
        return view('auth.clientRegister', ['url' => 'client']);
    }

    public function addClient(Request $data)
    {
        $client = new Client();
        if ($data->hasFile('profileImg')) {
            $profileImage = $client->saveImageWithNameInPublicPath($data['profileImg']);
        } else {
            $profileImage = null;
        }

        Client::create([
            'company_name' => $data['name'],
            'profile_image' => $profileImage,
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return redirect(route('client.login'));
    }
}
