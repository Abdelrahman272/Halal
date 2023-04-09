<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CouponRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'code' => 'required',Rule::unique('coupons')->ignore($this->id),
            'discount_type' => 'required',
            'discount_amount' => 'required|numeric|min:0|max:100',
            'max_uses' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date|after:now',
            'end_date' => 'required|date|after:start_date',
            // 'expires_at' => 'required|date|after:today',
        ];
    }
}
