<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class Class_ExerciseStoreRequest extends FormRequest
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
            'grade_id'=>'required|numeric|min:1',
            'style_id'=>'required|numeric|min:1',
            'date'=>'required|date|after:today',
            'time' => 'date_format:H:i',
        ];
    }
}
