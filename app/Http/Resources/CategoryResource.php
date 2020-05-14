<?php

namespace App\Http\Resources;

use App\Resources\BaseResource;
use Illuminate\Http\Request;

class CategoryResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'name' => $this['name'],
            'slug' => $this['slug'],
            'total_quiz' => $this->when($this->resource->relationLoaded('quizzes'), $this['total_quiz'])
        ];
    }
}
