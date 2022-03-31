<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserToken;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function verifyEmailAccount($user_id, $token){
        $user = User::find($user_id);
        $userToken = UserToken::where('user_id', $user_id)->where('user_email_token', $token)->first(); 
        
        if($userToken && $userToken->count() > 0 && $userToken->email_token_status == 0){
            $user->update(['email_verified_at' => date('Y-m-d H:i:s'), "email_token_status" => 2]);
            if($user->phone_number_verified_at === null){
                return to_route('auth.verify.user');
            } else {
                return to_route('user.home');
            }
        } else {
            $messageEmail = 'This email varification Token is expire. Please request another verification url on click "Click here to request another email verification url"';
            return view('auth.verify', compact('messageEmail'));
        }
    }

    public function verifyPhoneAccount($user_id, $token){
        $user = User::find($user_id);
        $userToken = UserToken::where('user_id', $user_id)->where('user_phone_token', $token)->first(); 
        
        if($userToken && $userToken->count() > 0 && $userToken->phone_token_status == 0){
            $user->update(['phone_number_verified_at' => date('Y-m-d H:i:s'), 'phone_token_status' => 2]);
            if($user->email_verified_at === null){
                return to_route('auth.verify.user');
            } else {
                return to_route('user.home');
            }
        } else {
            $messagePhone = 'This phone number varification Token is expire. Please request another verification url on click "Click here to request another Phone number verification url"';
            return view('auth.verify', compact('messagePhone'));
        }
    }

    public function resendEmailVarification(){
        $emailToken = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 6);

        $user = auth()->user();
        $userToken = $user->userToken;

        $userToken->update([
            'user_email_token'  => $emailToken,
        ]);

        sendMail('partials.email-template.verify-email', ['user_id' => $user->id,'token' => $emailToken], $user);
        $messageEmailResend = "A new varifcation url send to your registered email address";
        return view('auth.verify', compact('messageEmailResend'));
    }
    public function resendPhoneNumberVarification(){
        $phoneToken = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTVWXYZ"), 0, 6);        

        $user = auth()->user();
        $userToken = $user->userToken;
        $countryInfo = $user->country;

        $userToken->update([
            'user_phone_token'  => $phoneToken,
        ]);
        sendToken($phoneToken, "+".$countryInfo->phonecode.$user->phone_number, $user->id);

        $messagePhoneResend = "A new varifcation url send to your registered Phone Number";
        return view('auth.verify', compact('messagePhoneResend'));
    }
}
