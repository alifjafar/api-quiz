<?php


namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class BaseResource extends Resource
{
    private $status = 200;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public static function collection($resource)
    {
        return tap(new BaseCollection($resource, static::class), function ($collection) {
            if (property_exists(static::class, 'preserveKeys')) {
                $collection->preserveKeys = (new static([]))->preserveKeys === true;
            }
        });
    }

    public function with($request)
    {
        return [
            'meta' => [
                'http_status' => $this->status
            ]
        ];
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }
}
