<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use Socialite;
use Exception;
use Auth;

class SocialController extends Controller
{
    /* facebook login */
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
                    return to_route('home');
                } else {
                    $userData = [
                        'name'              => $user->name,
                        'email'             => $user->email,
                        'social_login_id'   => $user->id,
                        'register_status'   =>  1,
                    ];                
                    return view("auth.social-login-user", compact('userData', 'countries'));
                }    
            } catch (Exception $exception) {
                dd($exception->getMessage());
            }
        }
    /* google login */
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
                    return to_route('home');
                }else{
                    $userData = [
                        'name'              => $user->name,
                        'email'             => $user->email,
                        'social_login_id'   => $user->id,
                        'register_status'   =>  2,
                    ];                
                    return view("auth.social-login-user", compact('userData', 'countries'));
                }
        
            } catch (Exception $e) {
                dd($e->getMessage());
            }
        }
/* -------------------------------------- Save social login user ----------------------------------- */

    //  social user register
    function socialLoginUserStore(Request $request){
        if ($request->ajax()){
            $userToken = str()->random(32);
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
            $input['phone_number_verified_at'] = null;

            $input['user_token'] = $userToken;
            $user = User::create($input);
            $user->roles()->sync(3);

            $redirectUrl = route('home');
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
