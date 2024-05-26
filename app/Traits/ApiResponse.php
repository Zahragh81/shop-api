<?php

namespace App\Traits;

use Illuminate\Support\Facades\Response;

trait ApiResponse
{
    protected function successResponse($data, $code = 200)
    {
        return Response::json([
            'status' => true,
            'data' => $data
        ], $code);
    }

    protected function errorResponse($message, $code = 200)
    {
        return Response::json([
            'status' => false,
            'message' => $message,
        ], $code);
    }
}
