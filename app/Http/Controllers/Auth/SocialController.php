<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Validator;
use Socialite;
use Exception;
use App\Models\User;
use App\Models\Country;
use App\Models\UserToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class SocialController extends Controller
{
    function __construct()
    {
        // facebook
        config()->set('services.facebook.client_id', getSettingDetail('facebook_client_id')->value);
        config()->set('services.facebook.client_secret', getSettingDetail('facebook_client_secret')->value);
        config()->set('services.facebook.redirect', getSettingDetail('facebook_redirect_url')->value);

        // google
        config()->set('services.google.client_id', getSettingDetail('google_client_id')->value);
        config()->set('services.google.client_secret', getSettingDetail('google_client_secret')->value);
        config()->set('services.google.redirect', getSettingDetail('google_redirect_url')->value);
    }
    /* Facebook login */
        public function facebookRedirect()
        {
            return Socialite::driver('facebook')->redirect();
        }
        public function loginWithFacebook()
        {
            try {
                $countries = Country::all();
                $user = Socialite::driver('facebook')->user();
                $isUser = User::where('email', $user->email)->first();
                if($isUser){
                    Auth::login($isUser);
                    return to_route('user.home');
                } else {
                    $userData = [
                        'name'              => $user->name,
                        'email'             => $user->email,
                        'social_login_id'   => $user->id,
                        'register_type'   =>  1,
                    ];                
                    return view("auth.social-login-user", compact('userData', 'countries'));
                }    
            } catch (Exception $exception) {
                // dd($exception->getMessage());
                return abort(404);
            }
        }

    /* Google login */
        function redirectToGoogle(){
            return Socialite::driver('google')->redirect();
        }
        public function handleGoogleCallback() {
            try {
                $countries = Country::all();
                $user = Socialite::driver('google')->user();
                
                $isUser = User::where('email', $user->email)->first();
        
                if($isUser){
                    Auth::login($isUser);
                    return to_route('user.home');
                }else{
                    $userData = [
                        'name'              => $user->name,
                        'email'             => $user->email,
                        'social_login_id'   => $user->id,
                        'register_type'   =>  2,
                    ];                
                    return view("auth.social-login-user", compact('userData', 'countries'));
                }
        
            } catch (Exception $e) {
                // dd($e->getMessage());
                return abort(404);
            }
        }
/* -------------------------------------- Save social login user ----------------------------------- */

    //  Social user register
    function socialLoginUserStore(Request $request){
        if ($request->ajax()){
            
            $phoneToken = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 6);
            $emailToken = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 6);

            $input = $request->all();

            $validator = Validator::make($input, [
                'phone_number' => ['required', 'numeric', 'unique:users,phone_number'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'country_id' => ['exists:countries,id']
            ]);
            if (!$validator->passes()) {
                return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray(),'message'=>'Error Occured!'],400);
            }
            $input['password'] = Hash::make($input['password']);
            $input['email_verified_at'] = date('Y-m-d H:i:s');

            $country_id = Country::where('phonecode', $input['country_code'])->first()->id;
            $input['country_id'] = $country_id;

            $user = User::create($input);

            // twillo api
            sendToken($phoneToken, "+".$input['country_code'].$user->phone_number, $user->id);

            UserToken::create([
                'user_id'   => $user->id,
                'user_email_token'  => $emailToken,
                'email_token_status'    => 2,
                'user_phone_token'  => $phoneToken,
            ]);

            $user->assignRole(3);

            $redirectUrl = route('user.home');
            Auth::login($user);
            $response = [
                'success'   => true,
                'redirect_url'  => $redirectUrl,
                'message'   => "Resister Successfully",
            ];
            return response()->json($response);
        }        
    }
}
