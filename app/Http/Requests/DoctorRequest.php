<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
            'name' => '',
            'name_myan' => '',
            'phone' => '',
            'viber' => '',
            'facebook_url' => '',
            'from_date' => '',
            'to_date' => '',
            'lat' => '',
            'lng' => '',
            'address' => '',
            'note' => '',
            'fee_status' => '',
            'status' => '',
            'specialization_id' => '',
            'town_pcode' => '',
        ];
    }
}
