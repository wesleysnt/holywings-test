<?php

namespace App\Helpers;

class ResponseHelper
{
    public static function success( $message = 'Operation successful', $status = 200, $data = null)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $status);
    }

    public static function error($message = 'An error occurred', $status = 500, $data = null)
    {
        if ((int)$status == 0) {
            $status = 500;
        }
        return response()->json([
            'status' => (int)$status,
            'message' => $message,
            'data' => $data,
        ], $status);
    }
}
