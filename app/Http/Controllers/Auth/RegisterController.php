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
use Illuminate\Auth\Events\Registered;
use Auth as UserAuth;

use App\Models\UserToken;

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
        $countries = DB::table('countries')->get();
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
        $phoneToken = str()->random(32);
        $emailToken = str()->random(32);

        $input = $request->all();
        $this->validator($input)->validate();

        $input['password'] = Hash::make($input['password']);

        $input['register_type'] = 0;
        $phoneNumber = $input['phone_number'];

        $countryInfo = DB::table('countries')->where('id', $input['phone_country_id'])->first();

        $phoneNumberUtil = \libphonenumber\PhoneNumberUtil::getInstance();

        $phoneNumberObject = $phoneNumberUtil->parse($phoneNumber, $countryInfo->sortname);
        
        $numberType     = $phoneNumberUtil->getNumberType($phoneNumberObject);
        $possibleNumber = $phoneNumberUtil->isPossibleNumber($phoneNumberObject);
        $isValidNumber  = $phoneNumberUtil->isValidNumber($phoneNumberObject);

        

        /* if(!$possibleNumber && !$isValidNumber){
            return to_route('register')->withError('This number is not valid')->withInput();
        } 
        if($numberType != 1 || $numberType != 2){
            return to_route('register')->withError('Please use mobile number')->withInput();
        } */

        // twillo api
        sendOtp($phoneToken, "+".$countryInfo->phonecode.$phoneNumber);
        /* $receiverNumber = $countryInfo->phonecode.$phoneNumber;
        $message = "This is testing otp from tecsms".$otp;
        try {  
            $account_sid = env("TWILIO_SID");
            $auth_token = env("TWILIO_TOKEN");
            $twilio_number = env("TWILIO_FROM");
  
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message]);
  
            dd('SMS Sent Successfully.');
  
        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        } */
        dd($numberType, $possibleNumber, $isValidNumber);

        // create user
        $user = User::create($input);
        // Login user
        UserAuth::login($user);
        // verify email
        event(new Registered($user));
        // add role
        $user->roles()->sync(3);
        // add tokens
        UserToken::create([
            'user_di'   => $user->id,
            'user_email_token'  => $emailToken,
            'user_phone_token'  => $phoneToken,
        ]);
        return to_route('home');        
    }
}
