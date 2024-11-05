<?php

namespace App\Services;

use Illuminate\Http\JsonResponse;

class ApiResponse
{

    public static function success($data = null, $message = "success", $code = 200): JsonResponse
    {
        return response()->json([
            'status_code' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public static function error($message = 'error', $code = 500): JsonResponse
    {
        return response()->json([
            'status_code' => $code,
            'message' => $message,
        ], $code);
    }

    public static function unauthorized($message = 'unauthorized', $code = 401): JsonResponse
    {
        return response()->json([
            'status_code' => $code,
            'message' => $message,
        ], $code);
    }
}
