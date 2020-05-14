<?php

namespace App\Resources;


use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class BaseResponse
{
    private $data = [];
    private $message = null;
    private $meta;
    private $status = Response::HTTP_OK;

    public function __construct()
    {
        $this->meta = Arr::add($this->meta, 'http_status', $this->status);
        return $this;
    }

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function build()
    {
        return response()->json([
            'message' => $this->message,
            'data' => $this->data,
            'meta' => $this->meta
        ], $this->status);
    }

}
