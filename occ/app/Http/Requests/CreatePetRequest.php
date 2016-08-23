<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class CreatePetRequest extends Request
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
            'name' => 'required| min:2',
            'gender' => 'required',
            'is_spayed_neutered' => 'required',
            'birth_date' => 'required | date',
            'breed' => 'required',
            'pet_record' => 'mimes:doc,pdf,docx,zip,jpeg,png | required_if:has_records,1',
        ];
    }
}
