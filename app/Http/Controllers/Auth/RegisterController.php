<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;
use Auth as UserAuth;
use App\Models\UserToken;
use App\Models\Country;

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

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function showRegistrationForm()
    {
        $countries = Country::all();
        return view('auth.register', compact('countries'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'numeric', 'unique:users,phone_number'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_country_id' => ['exists:countries,id']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
    {
        // $phoneToken = str()->random(32);
        // $emailToken = str()->random(32);

        $phoneToken = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 6);
        $emailToken = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 6);

        $input = $request->all();
        $this->validator($input)->validate();

        $input['password'] = Hash::make($input['password']);

        $input['register_type'] = 0;
        $countryInfo = Country::where('id', $input['phone_country_id'])->first();

        // create user
        $user = User::create($input);

        // twillo api
        sendToken($phoneToken, "+".$countryInfo->phonecode.$user->phone_number, $user->id);
        // Login user
        UserAuth::login($user);
        // verify email
        sendMail('partials.email-template.verify-email', ['user_id' => $user->id,'token' => $emailToken], $user);
        
        // add role
        $user->assignRole(3);
        // add tokens
        UserToken::create([
            'user_id'   => $user->id,
            'user_email_token'  => $emailToken,
            'user_phone_token'  => $phoneToken,
        ]);
        return to_route('user.home');        
    }
}
