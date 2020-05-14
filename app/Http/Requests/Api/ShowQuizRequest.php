<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class ShowQuizRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => ['required_if:is_private,true', function($attribute, $value, $fail) {
                if($value !== $this->get('quiz_password')) {
                    $fail($attribute.' is incorrect.');
                }
            }]
        ];
    }

    protected function getValidatorInstance()
    {
        $quiz = $this->quiz;

        $isPrivate = data_get($quiz, 'is_private');
        $password = data_get($quiz, 'password');

        $this->merge([
            'is_private' => (bool)$isPrivate,
            'quiz_password' => $password
        ]);

        return parent::getValidatorInstance();
    }


}
