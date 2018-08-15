<?php

namespace App\Http\Controllers\Auth;

use App\Invite;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    public $lockRegistration;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //TODO: Make this a setting in admin
        $this->lockRegistration = true;

        if ($this->lockRegistration) {
            $this->middleware('registration.invite');
        } else {
            $this->middleware('guest');
        }
    }

    public function showRegistrationForm($token = null)
    {
        $invite = null;
        $lockRegistration = $this->lockRegistration;

        if ($token && $invite = Invite::where('token' , '=', $token)->first()) {
        }

        return view('auth.register', compact('invite', 'lockRegistration'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $validation = [
            'name' => 'required|string|max:255',
            'birthday' => 'nullable|date_format:Y-m-d',
            'password' => 'required|string|min:6|confirmed',
        ];

        if (!$this->lockRegistration) {
            $validation['email'] = 'required|string|email|max:255|unique:users';
        }

        return Validator::make($data, $validation);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $token = array_key_exists('control', $data) ? $data['control'] : null;

        if ($token && $invite = Invite::where('token' , '=', $token)->first()) {
            $data['email'] = $invite->email;
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'birthday' => $data['birthday'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
