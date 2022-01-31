<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserInformationRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'address'  => ['required', 'string', 'max:255'],
            'city'     => ['required', 'string', 'max:255'],
            'zip_code' => ['required', 'string', 'max:255'],
            'mobile'   => ['required', 'string', 'max:255'],
        ];
    }

    public function messages() {
        return [
            'address.required'  => 'Please write Your address',
            'city.required'     => 'Please write Your city',
            'zip_code.required' => 'Please write Your zip_code',
            'mobile.required'   => 'Please write Your mobile',
        ];
    }
}
