<?php

use Twilio\Rest\Client;

if (! function_exists('sendOtp')) {
    function sendOtp($otp, $receiverNumber) {
        $message = 'This is testing phone number verification from tecsms <a href="">Verify phone number</a>'.$otp;
        try {  
            $account_sid    = env("TWILIO_SID");
            $auth_token     = env("TWILIO_TOKEN");
            $twilio_number  = env("TWILIO_FROM");
  
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message]);
  
            return true;
  
        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }
}
