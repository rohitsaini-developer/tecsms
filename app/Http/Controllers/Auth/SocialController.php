<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Validator;
use Socialite;
use Exception;
use App\Models\User;
use App\Models\UserToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class SocialController extends Controller
{
    /* Facebook login */
        public function facebookRedirect()
        {
            return Socialite::driver('facebook')->redirect();
        }
        public function loginWithFacebook()
        {
            try {
                $countries = \DB::table('countries')->get();
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
                $countries = \DB::table('countries')->get();
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
            $phoneToken = str()->random(32);
            $emailToken = str()->random(32);
            $input = $request->all();

            $validator = Validator::make($input, [
                'phone_number' => ['required', 'numeric', 'unique:users,phone_number'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'phone_country_id' => ['exists:countries,id']
            ]);
            if (!$validator->passes()) {
                return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray(),'message'=>'Error Occured!'],400);
            }

            $input['password'] = Hash::make($input['password']);
            $input['email_verified_at'] = date('Y-m-d H:i:s');

            $countryInfo = \DB::table('countries')->where('id', $input['phone_country_id'])->first();
            $phoneNumber = $input['phone_number'];

            sendOtp($phoneToken, "+".$countryInfo->phonecode.$phoneNumber);

            $user = User::create($input);

            UserToken::create([
                'user_id'   => $user->id,
                'user_email_token'  => $emailToken,
                'email_token_status'    => 2,
                'user_phone_token'  => $phoneToken,
            ]);

            $user->roles()->sync(3);

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
