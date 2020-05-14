<?php

namespace App\Http\Resources;

use App\Resources\BaseResource;

class OptionResource extends BaseResource
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
            'content' => $this['content']
        ];
    }
}
