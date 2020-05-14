<?php

namespace App\Http\Resources;

use App\Resources\BaseResource;

class QuestionResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'content' => $this['content'],
            'options' => OptionResource::collection($this['options']),
            'answer' => $this->when(
                $this->resource->relationLoaded('answer') && $this->answer->relationLoaded('option'),
                OptionResource::make($this['answer']['option']))
        ];
    }
}
