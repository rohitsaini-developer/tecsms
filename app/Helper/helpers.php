<?php
use Twilio\Rest\Client;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail; 

if (!function_exists('pageTitle')) {
    function pageTitle() {
        $reqPathInfo = ltrim(request()->getPathInfo(), '/');
        $parsePathInfo = explode("/",$reqPathInfo);
        $title = "";
        if(!empty($parsePathInfo) && is_array($parsePathInfo)){
            foreach($parsePathInfo AS $key => $path){
                if($path == 'admin'){
                    continue;
                }
                if($key <= 5){
                    if(is_string($path) && !is_numeric($path)){
                        $singular = Str::singular($path);
                        $title .= ucwords(str_replace('-', ' ', preg_replace('/[\s-]+/', '-', $singular)))." ";
                    }
                }
            }
        }
        return $title;
    }
}


if (!function_exists('sendToken')) {
    function sendToken($token, $receiverNumber, $user_id) {
        $message = 'This is testing phone number verification from tecsms <a href="'.route('user.verify.phone', ['user_id' => $user_id, 'token' => $token]).'">Verify phone number</a>
        <p>If This link is not then you can copy and paste this url '.route('user.verify.phone', ['user_id' => $user_id, 'token' => $token]).'</p>';

        try {
            $client = new Client(getSettingDetail('twilio_sid')->value,getSettingDetail('twilio_token')->value);
            $client->messages->create($receiverNumber, [
                'from' => getSettingDetail('twilio_from_number')->value, 
                'body' => $message
            ]);
            return true;
  
        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }
}

if (!function_exists('sendMail')) {
    function sendMail($email_template, $data, $user, $subject) {
        Mail::send($email_template, $data, function($message) use($user, $subject){
            $message->to($user->email);
            $message->subject($subject);
        });
    }
}
if (!function_exists('is_active')) {
    function is_active($route) {
        return request()->routeIs($route) ? 'active' : '';
    }
}
if (!function_exists('getSettingDetail')) {
    function getSettingDetail(string $key = null){
		$setting = Setting::where('key', $key)->first();
		return $setting;
	}
}

if(!function_exists('breadcrumbs')){
    function breadcrumbs(){
        $breadcrumbs = [];
        foreach(request()->segments() as $key => $segment){
            $breadcrumbs[$segment] = implode('/', array_slice(request()->segments(), 0, $key+1));
        }
        return $breadcrumbs;
    }
}