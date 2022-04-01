<?php

namespace App\Http\Requests\User;

use Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('user-store'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return true;
    }
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required', 
                'string', 
                'max:255'
            ],
            'email' => [
                'required', 
                'string', 
                'email', 
                'max:255', 
                'unique:users'
            ],
            'phone_number' => [
                'required', 
                'numeric', 
                'unique:users,phone_number'
            ],
            'password' => [
                'required', 
                'string', 
                'min:8', 
            ],
            'phone_country_id' => [
                'required',
                'exists:countries,id'
            ]
        ];
    }
}
