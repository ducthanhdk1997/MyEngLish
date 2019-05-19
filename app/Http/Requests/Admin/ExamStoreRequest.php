<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ExamStoreRequest extends FormRequest
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
            'deadline' => 'required|date_format:Y-m-d|before:start_date',
            'title' =>'required',
            'classroom_id' => 'required',
            'shift_id' => 'required',
            'course' => 'required'
        ];
    }
}
