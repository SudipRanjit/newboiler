<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RadiatorPriceRequest extends FormRequest
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
        
       return [
                'radiator_type_id' => 'required',
                'radiator_length_id' => 'required',
                'radiator_height_id' => 'required',
                'price' => 'required',
                'btu' => 'required',
            ];

    }
}
