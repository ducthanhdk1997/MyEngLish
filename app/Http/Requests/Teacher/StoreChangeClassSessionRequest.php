<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class StoreChangeClassSessionRequest extends FormRequest
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
            //
            'start_date' => 'required|date_format:Y-m-d|after:yesterday',
            'class_session' => 'required',
            'classroom_id' => 'required',
            'shift_id' => 'required',
            'reason' => 'required'
        ];
    }
}
