<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
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
            'product'       => ['required', 'exists:products,slug'],
            'variation'     => ['required', 'exists:variations,id'],
            'price'         => ['required', 'numeric'],
            'qty'           => ['required', 'numeric', 'gt:0'],
            'size'          => ['required', 'exists:variation_sizes,id'],
            'style'         => ['required', 'exists:variation_styles,id'],
        ];
    }
}
