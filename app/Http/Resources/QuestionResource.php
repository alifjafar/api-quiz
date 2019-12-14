<?php

namespace App\Http\Resources;

class QuestionResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'content' => $this['content'],
            'options' => OptionResource::collection($this['options'])
        ];
    }
}
