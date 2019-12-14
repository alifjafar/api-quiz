<?php

namespace App\Http\Resources;

class QuizWithQuestionResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $quizResource = QuizResource::make($this)->toArray($request);
        $data  = [

            'questions' => QuestionResource::collection($this['questions'])
        ];

        return array_merge($quizResource, $data);
    }
}
