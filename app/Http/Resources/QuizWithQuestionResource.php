<?php

namespace App\Http\Resources;

use App\Resources\BaseResource;
use Illuminate\Http\Request;

class QuizWithQuestionResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request $request
     * @return array
     */
    public function toArray($request)
    {
        $quizResource = QuizResource::make($this)->toArray($request);
        $data  = [
            'questions' => QuestionResource::collection($this['questions'])->toArray(null)
        ];

        return array_merge($quizResource, $data);
    }
}
