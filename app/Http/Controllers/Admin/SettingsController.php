<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Models\Setting;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class SettingsController extends Controller
{
    protected $folder;

    /**
     * __construct functoion
     */
    public function __construct()
    {
        $this->folder =  'settings';
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change()
    {
        abort_if(Gate::denies('change-setting'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = Setting::orderBy('group', 'ASC')->get();
        $settings = $data->groupBy('group');
        return view('admin.settings.change', compact('settings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateChange(Request $request)
    {
        abort_if(Gate::denies('change-setting-update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $settings = Arr::except($request->all(), ['_token', 'active_tab']);
        $group = $settings['setval'];
        $settings = $settings[$group];
        $rules = [];
        foreach ($settings as $key => $value) {
            $setting = getSettingDetail($key);
            if (isset($setting->type) && $setting->type == 'number') {
                $rules[$key] = 'required|numeric|min:0';
            }
            if (isset($setting->type) && $setting->type == 'text') {
                if ($setting->group == 'social' || $setting->group == 'footer') {
                    $rules[$key] = 'nullable';
                }else{
                    $rules[$key] = 'required|string';
                }
            }
            if (isset($setting->type) &&  $setting->type == 'text_area') {
                $rules[$key] = 'required|string';
            }
            if (isset($setting->type) &&  $setting->type == 'file') {
                $rules[$key] = 'nullable|required|max:10000|mimes:doc,docx,pdf';
            }
            if (isset($setting->type) &&  $setting->type == 'image') {
                $rules[$key] = 'nullable|image|max:15360|mimes:jpeg,png,jpg,PNG,JPG';
            }
            if (isset($setting->type) &&  $setting->type == 'dropdown') {
                $dropdown = json_decode($setting->details);
                $dropdown =  (array) $dropdown->options;
                $dropdown = array_keys($dropdown);
                $rules[$key] = 'required|in:' . implode(',', $dropdown);
            }

            if (isset($setting->type) && $setting->type == 'radio_btn') {
                $radiobtn = json_decode($setting->details);
                $radiobtn =  (array) $radiobtn->options;
                $radiobtn = array_keys($radiobtn);
                $rules[$key] = 'required|in:' . implode(',', $radiobtn);
            }

            if (isset($setting->type) && $setting->type == 'checkbox') {
                $checkbox = json_decode($setting->details);
                $checkboxArray =  (array) $checkbox->options;
                $checkboxKey = array_keys($checkboxArray);
                if (is_array($value) == false) {
                    $rules[$key] = 'required|in:' . implode(',', $checkboxKey);
                } else {
                    $containsAllValues = !array_diff($value, $checkboxKey);
                    if ($containsAllValues == false) {
                        $rules[$key] = 'required';
                    }
                }
            }
        }

        foreach($rules as $key => $value){
            $requ_field[$group.'.'.$key] = $value;
        }
        
        $customMessages = [
            'required' => 'The field is required.',
            'site.website_logo.image' => 'The website logo must be an image.',
            'site.website_logo.mimes' => 'The website logo must be jpeg,png,jpg,PNG,JPG.',
            'site.website_logo.max'   => 'The website logo maximum size is 15.36MB.',
            'site.mobile_logo.image' => 'The mobile logo must be an image.',
            'site.mobile_logo.mimes' => 'The mobile logo must be jpeg,png,jpg,PNG,JPG.',
            'site.mobile_logo.max'   => 'The mobile logo maximum size is 15.36MB.',
            'site.favicon.image' => 'The favicon icon must be an image.',
            'site.favicon.mimes' => 'The favicon icon must be jpeg,png,jpg,PNG,JPG.',
            'site.favicon.max'   => 'The favicon icon maximum size is 15.36MB.'
        ];
        $validator = $request->validate($requ_field,$customMessages);
       
        $flag = false;
        foreach ($settings as $key => $value) {
            $setting_key = $key;
            $setting_value = $value;
            $setting = Setting::where('key', $setting_key)->first();
            
            if ($setting) {
                if ($setting->type == 'checkbox') {
                    $setting_value = implode(",", $value);
                }

                if($setting->key == 'phone_number' && $setting->group == 'company'){
                    $setting_value = '+'.$request->country_code.'-'.$value;
                }

                if (($setting->type == 'image' || $setting->type == 'file') && $request->hasFile($group.'.'.$key)) {
                    if(!empty($setting->value) && Str::contains($setting->value, 'storage')){
                        $settingPath = str_replace('storage/', '', $setting->value);
                    } else {
                        $settingPath = $setting->value;
                    }
                    if(!empty($setting->value) && !Str::contains($settingPath, 'default')){
                        if (Storage::disk('public')->exists($settingPath)) {
                            Storage::disk('public')->delete($settingPath);
                        }
                    }
                    $path = $request->file($group.'.'.$key)->store($this->folder, 'public');
                    $setting_value = 'storage/'.$path;
                    //dd($setting_value);
                }
                $setting->value = $setting_value;
                $setting->save();
            }
            
            $flag=true;
        }
        

        if($flag == true){
            return back()->withInput(['active_tab' => $request->active_tab])->with('success', 'Change settings successfully!');
        }else{
            return back()->withInput(['active_tab' => $request->active_tab])->with('error', 'Something went wrong! Try after some time.');
        }
        

    }
}
