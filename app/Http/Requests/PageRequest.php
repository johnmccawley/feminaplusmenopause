<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PageRequest extends Request
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
            'name' => 'required|max:255',
            'cardNumber' => 'required|min:16|max:16',
            'expiration' => 'required|max:7',
            'cvc' => 'required|max:4',
            // 'product' => 'required'
        ];
    }
}
