<?php

namespace App\Traits;

trait ApiResponse
{
    protected function successResponse($data, $code = 200)
    {
        return response()->json([
            'status'=> 'success',
            'data' => $data
        ], $code);
    }

    protected function errorResponse($code, $message)
    {
        return response()->json([
            'status'=>'error',
            'message' => $message,
            'data' => null
        ], $code);
    }
}
