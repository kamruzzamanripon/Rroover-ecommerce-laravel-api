<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest {
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
            'name'         => 'required|string|max:258|unique:products,name,' . $this->id,
            'quantity'     => 'required',
            'color'        => 'required|string',
            'actual_price' => 'required',
            //'image'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ];
    }
}
