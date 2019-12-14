<?php

namespace App\Exceptions;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class ErrorResponse
{
    public function make(\Exception $exception, $code = 500): JsonResponse
    {
        if ($exception instanceof NotFoundHttpException) {
            return $this->errorResponse("Not Found", $code);
        } elseif ($exception instanceof UnauthorizedHttpException) {
            return $this->errorResponse('Unauthorized', Response::HTTP_UNAUTHORIZED);
        } elseif ($exception instanceof ModelNotFoundException) {
            return $this->errorResponse($this->modelNotFoundMessage($exception->getModel()), $code);
        } elseif ($exception instanceof ValidationException) {
            return $this->validation($exception, $code);
        } elseif ($exception instanceof MethodNotAllowedHttpException) {
            throw new NotFoundHttpException();
        } elseif ($code === Response::HTTP_INTERNAL_SERVER_ERROR) {
            return $this->internalServerError($exception, $code);
        }

        return $this->errorResponse($exception->getMessage(), $code);

    }

    public function errorResponse($message, $code, $trace = null, $attribute = null)
    {
        if ($trace) {
            $data = [
                'errors' => [
                    [
                        'attribute' => $attribute,
                        'message' => [
                            $message
                        ],
                        'trace' => $trace,
                    ]
                ],
                'meta' => [
                    'http_status' => $code
                ]
            ];
        } else {
            $data = [
                'errors' => [
                    [
                        'attribute' => $attribute,
                        'message' => [
                            $message
                        ]
                    ]
                ],
                'meta' => [
                    'http_status' => $code
                ]
            ];
        }

        return JsonResponse::create($data, $code);
    }

    private function validation(ValidationException $exception, $code): JsonResponse
    {
        return JsonResponse::create([
            'message' => $exception->getMessage(),
            'errors' => $this->transformValidationError($exception->errors()),
            'meta' => [
                'http_status' => $code
            ]
        ], $code);
    }

    private function modelNotFoundMessage(string $model): string
    {
        return str_replace('App\\Models\\', '', $model) . ' not found';
    }

    private function fileNotFoundMessage(string $message): string
    {
        return 'file not found at path: ' . $message;
    }

    private function transformValidationError($errors)
    {
        $err = new Collection();
        foreach ($errors as $key => $value) {
            $err->push([
                'attribute' => $key,
                'message' => $value
            ]);
        }

        return $err;
    }

    private function internalServerError(\Exception $exception, $code)
    {
        $trace = config('app.debug') ? $exception->getTraceAsString() : null;
        if ($exception instanceof FileNotFoundException) {
            return $this->errorResponse($this->fileNotFoundMessage($exception->getMessage()), $code, $trace);
        }
        return $this->errorResponse($exception->getMessage(), $code, $trace);
    }
}
