<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class SubmitQuizRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'questions' => 'required|array',
            'questions.*.id' => 'required|exists:questions,id',
            'questions.*.answer' => 'required|exists:options,id'
        ];
    }
}
