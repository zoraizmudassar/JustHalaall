<?php
namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse {

    public function successResponse($data = [], $message = '' , $status = 200): JsonResponse
    {
        return response()->json([
            'status' => 200,
            'data' => $data,
            'message' => $message
        ], 200);
    }

    public function errorMessage($message = '' , $status = 404): JsonResponse
    {
        return response()->json([
            'status' => 404,
            'message' => $message
        ], 404);
    }

}
