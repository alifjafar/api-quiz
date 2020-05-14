<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class QuizRequest extends FormRequest
{

    public function authorize()
    {
        $hasAuthorize = true;

        if ($this->method() == 'PUT' || $this->method() == 'PATCH') {
            $hasAuthorize = Gate::allows('update', $this->quiz);
        }

        return $hasAuthorize;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'is_private' => 'required|boolean',
            'password' => 'required_if:is_private,true',
            'questions' => 'required|array',
            'questions.*.content' => 'required|string',
            'questions.*.options.*.content' => 'required|string',
            'questions.*.options.*.answer' => 'sometimes|boolean',
        ];
    }

    protected function getValidatorInstance()
    {
        if ($this->method() == 'PUT' || $this->method() == 'PATCH') {
            $this->merge([
                'questions.*.id' => 'sometimes|exists:questions,id',
                'questions.*.options.*.id' => 'sometimes|exists:options,id',
            ]);
        }

        return parent::getValidatorInstance();
    }
}
