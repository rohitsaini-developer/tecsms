<?php

namespace App\Http\Requests\Package;

use Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        abort_if(Gate::denies('postpaid-user-update'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
                'max:255',
                'unique:packages,name,'.$this->package->id,
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
                'max:99999999.99'
            ],
            'sale_price' => [
                'nullable',
                'numeric',
                'min:0',
                'max:99999999.99'
            ],
            'validity' => [
                'required',
                'numeric',
                'min:0',
                'max:99999999'
            ],
        ];
    }
}
