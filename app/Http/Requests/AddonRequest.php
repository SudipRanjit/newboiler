<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->method() == 'POST')
            return [
                'addon_name' => 'required|max:255',
                'price' => 'required'
            ];
        else
            return [
                'addon_name' => 'required|max:255',
                'price' => 'required'
            ];

    }
}
