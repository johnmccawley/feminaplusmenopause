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
            'shipping-name-first' => 'required_without:billing-same',
            'shipping-name-last' => 'required_without:billing-same',
            'shipping-email' => 'required_without:billing-same',
            'shipping-phone' => 'required_without:billing-same|max:14',
            'shipping-address-1' => 'required_without:billing-same',
            'shipping-city' => 'required_without:billing-same',
            'shipping-state' => 'required_without:billing-same',
            'shipping-zip' => 'required_without:billing-same|min:5|max:10',
            'cardName' => 'required',
            'cardNumber' => 'required|min:16|max:16',
            'cardExpiration' => 'required|max:7',
            'cardCvc' => 'required|max:4'
        ];
    }
}
