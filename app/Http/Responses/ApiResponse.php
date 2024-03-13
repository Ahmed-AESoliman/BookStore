<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    /**
     * @param $data
     * @param $message
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function success($data = null, $message = null, int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'statusCode' => $statusCode,
            'message' => $message,
            'errorMessages' => [],
        ]);
    }

    /**
     * @param string $message
     * @param int $statusCode
     * @param array $errorMessages
     * @return JsonResponse
     */
    public static function error(string $message = 'An error occurred', int $statusCode = 400, array $errorMessages = []): JsonResponse
    {
        return response()->json([
            'data' => null,
            'statusCode' => $statusCode,
            'message' => $message,
            'errorMessages' => $errorMessages,
        ], $statusCode);
    }
}
