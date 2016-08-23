<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class CreateClassesRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // if(!Auth::user()->isAdmin()) {
        //     return false;
        // }
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
            'day_of_week' => 'required|min:3',
            'begin_date' => 'required|date',
            'end_date' => 'required|date',
            'entrance' => 'required',
            'capacity' => 'required|integer',
        ];
    }
}
