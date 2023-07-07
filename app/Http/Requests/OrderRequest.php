<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'first_name'    => ['required', 'string', 'max:255'],
            'last_name'     => ['string', 'max:255'],
            'email'         => ['required', 'email'],
            'phone'         => ['required', 'string', 'min:7'],
            'country'       => ['required', 'string', 'max:255'],
            'address'       => ['required', 'string', 'max:300'],
            'state'         => ['required', 'string', 'max:255'],
            'city'          => ['required', 'string', 'max:255'],
            'zip'           => ['required', 'string', 'min:3'],
            'notes'         => ['string', 'max:400'],
        ];
    }
}
