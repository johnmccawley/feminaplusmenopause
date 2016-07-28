<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CouponRequest extends Request
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
            'coupon-code' => 'required',
            'coupon-percent' => 'required_without:coupon-amount',
            'coupon-amount' => 'required_without:coupon-percent'
        ];
    }
}
