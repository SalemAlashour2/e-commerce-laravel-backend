<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait ResponseTrait
{

    protected function responseOk($msg, $data): JsonResponse
    {

        return response()->json([
            'code' => Response::HTTP_OK,
            'message' => $msg,
            'data' => $data
        ],Response::HTTP_OK);
    }

    protected function responseFailedValidation($msg, $data): JsonResponse
    {
        return response()->json([
            'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message' => $msg,
            'data' => $data
        ],Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    protected function responseUnauthorized($msg,$data): JsonResponse
    {
        return response()->json([
            'code' => Response::HTTP_UNAUTHORIZED,
            'message' => $msg,
            'data' => $data
        ],Response::HTTP_UNAUTHORIZED);
    }

    protected function responseCreated($msg,$data): JsonResponse
    {
        return response()->json([
            'code' => Response::HTTP_CREATED,
            'message' => $msg,
            'data' => $data
        ],Response::HTTP_CREATED);
    }

    protected function responseUnauthenticated($msg,$data): JsonResponse
    {
        return response()->json([
            'code' => Response::HTTP_UNAUTHORIZED,
            'message' => $msg,
            'data' => $data
        ],Response::HTTP_UNAUTHORIZED);
    }
}
