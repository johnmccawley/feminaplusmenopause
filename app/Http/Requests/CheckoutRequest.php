<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CheckoutRequest extends Request
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
            'billing-name-first' => 'required',
            'billing-name-last' => 'required',
            'billing-email' => 'required',
            'billing-phone' => 'required|max:14',
            'billing-address-1' => 'required',
            'billing-city' => 'required',
            'billing-state' => 'required',
            'billing-zip' => 'required|min:5|max:10',
            'shipping-phone' => 'max:14',
            'shipping-zip' => 'min:5|max:10',
            'name' => 'required',
            'cardNumber' => 'required|min:16|max:16',
            'expiration' => 'required|max:7',
            'cvc' => 'required|max:4'
        ];
    }
}
