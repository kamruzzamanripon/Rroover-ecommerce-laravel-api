<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest {
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

        if ( request()->isMethod( 'post' ) ) {
            return [
                'name'         => 'required|string|max:258|unique:products',
                'quantity'     => 'required',
                'color'        => 'required|string',
                'actual_price' => 'required',
                'image'        => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            ];
        } else {
            return [
                'name' => 'string|max:258|unique:products',

            ];
        }

    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages() {
        if ( request()->isMethod( 'post' ) ) {
            return [
                'name.required'         => 'Product Name is required!',
                'quantity.required'     => 'Product Quantity is required!',
                'color.required'        => 'color is required!',
                'actual_price.required' => 'actual_price is required!',
                'image.required'        => 'images is required!',
            ];
        } else {
            return [
                //'name.unique' => 'Name is unique!',

            ];
        }
    }
}
