<?php

namespace App\Http\Resources;

class QuestionResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'content' => $this['content'],
            'options' => OptionResource::collection($this['options']),
            'answer' => $this->whenLoaded('answer', $this->when($this->answer->relationLoaded('option'), OptionResource::make($this['answer']['option'])))
        ];
    }
}
