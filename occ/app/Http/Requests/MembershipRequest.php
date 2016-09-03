<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class MembershipRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::guest()) {
            return false;
        }
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
            'membership_type_id' => 'required|integer',
            'payment_method' => 'required|in:check,paypal'
        ];
    }
}
