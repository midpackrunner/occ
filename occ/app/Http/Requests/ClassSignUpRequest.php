<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;
use App\Pet;
class ClassSignUpRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user_id = Auth::user()->id;
        $pet = Pet::findOrFail($this->pet_id);
        if ($user_id == $pet->user->id  && !Auth::guest()) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'class_id' => 'required|integer',
            'pet_id' => 'required|integer',
            'payment_method' => 'required|in:check,paypal,volhours'
        ];
    }
}
