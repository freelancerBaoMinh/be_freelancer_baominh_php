<?php

namespace App\Traits;

trait ApiResponse
{

    public function errorResponse($message, $code): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => $code,
            'message' => $message,
            'data'=>new \stdClass()
        ], 200);
    }

    public function successResponseMessage($data, $code = 200, $message = ''): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => $code,
            'message' => $message,
            'data' => $data,
        ], 200);
    }
}
