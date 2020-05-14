<?php

namespace App\Resources;

use Illuminate\Pagination\AbstractPaginator;

class BaseCollection extends CustomResourceCollection
{
    public $collects;

    /**
     * Create a new anonymous resource collection.
     *
     * @param mixed $resource
     * @param string $collects
     * @return void
     */
    public function __construct($resource, $collects)
    {
        $this->collects = $collects;
        parent::__construct($resource);
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function with($request)
    {
        return [
            'meta' => [
                'http_status' => 200
            ]
        ];
    }

    public function toResponse($request)
    {
        return $this->resource instanceof AbstractPaginator
            ? (new CustomPaginateResourceResponse($this))->toResponse($request)
            : parent::toResponse($request);
    }

 }
