<?php

namespace App\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BaseResource extends JsonResource
{
    private $status = 200;
    private $message = 'Success Retrieved Data';

    /**
     * Transform the resource into an array.
     *
     * @param Request $request
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

    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    public function getMessage()
    {
        return [
            'message' => $this->message
        ];
    }

    public function toResponse($request)
    {
        return (new CustomResourceResponse($this))->toResponse($request);
    }
}
