<?php

use Twilio\Rest\Client;
use Illuminate\Support\Facades\Mail; 

if (! function_exists('sendToken')) {
    function sendToken($token, $receiverNumber, $user_id) {
        $message = 'This is testing phone number verification from tecsms <a href="'.route('user.verify.phone', ['user_id' => $user_id, 'token' => $token]).'">Verify phone number</a>
        <p>If This link is not then you can copy and paste this url '.route('user.verify.phone', ['user_id' => $user_id, 'token' => $token]).'</p>';

        try {
            $twilio_number  = "+17168696043";
            $client = new Client("ACf4ff923ef0a459595ca29bdf24e5c198","f4f1a0141b8b4cd9cdf70c4699e27a0d");
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message
            ]);
            return true;
  
        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }
}

if (! function_exists('sendMail')) {
    function sendMail($email_template, $data, $user) {
        Mail::send($email_template, $data, function($message) use($user){
            $message->to($user->email);
            $message->subject('Email Verification Mail');
        });
    }
}