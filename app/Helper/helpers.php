<?php
use Twilio\Rest\Client;
use Illuminate\Support\Str;

if (!function_exists('pageTitle')) {
    function pageTitle()
    {
        $reqPathInfo = ltrim(request()->getPathInfo(), '/');
        $parsePathInfo = explode("/",$reqPathInfo);
        $title = "";
        $count = 1;
        if(!empty($parsePathInfo) && is_array($parsePathInfo)){
            foreach($parsePathInfo AS $path){
                if($count <= 3){
                    if(is_string($path) && !is_numeric($path)){
                        $singular = Str::singular($path);
                        $ucFirst = Str::ucfirst($singular);
                        $title .= preg_replace('/[\s-]+/', '-', $ucFirst)." ";
                    }
                }
                $count++;
            }
        }
        return $title;
    }
}

if (! function_exists('sendOtp')) {
    function sendOtp($otp, $receiverNumber) {
        $message = "This is testing otp from tecsms".$otp;
        try {  
            $account_sid    = env("TWILIO_SID");
            $auth_token     = env("TWILIO_TOKEN");
            $twilio_number  = env("TWILIO_FROM");
  
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message]);
  
            dd('SMS Sent Successfully.');
  
        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }
}
