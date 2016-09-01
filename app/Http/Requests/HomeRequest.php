<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class HomeRequest extends Request
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
            'user-name' => 'required',
            'user-email' => 'required',
            'user-phone' => 'required|max:14',
            'user-address-1' => 'required',
            'user-city' => 'required',
            'user-state' => 'required',
            'user-zip' => 'required',
        ];
    }
}
