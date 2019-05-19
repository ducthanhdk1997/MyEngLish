<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ExamPreviewRequest extends FormRequest
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
            'fScore' => 'numeric|min:0|max:999',
            'lScore' => 'numeric|min:0|max:999',
            'type' => 'numeric',
            'num_studen_1' => 'numeric',
            'num_studen_2' => 'numeric|min:0',
            'class' => 'required',
            'filCourse' => 'required'
        ];
    }
}
