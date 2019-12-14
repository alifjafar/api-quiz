<?php

namespace App\Http\Resources;

class CategoryResource extends BaseResource
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
            'name' => $this['name'],
            'slug' => $this['slug'],
            'total_quiz' => $this->whenLoaded('quizzes', $this['total_quiz'])
        ];
    }
}
