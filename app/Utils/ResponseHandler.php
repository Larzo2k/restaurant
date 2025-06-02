<?php

namespace App\Utils;

use Illuminate\Http\Response;

class ResponseHandler
{
    public static function success($statusCode = Response::HTTP_OK, $message, $data = null)
    {
        return response()->json([
            'Code' => $statusCode,
            'Message' => $message,
            'Data' => $data
        ], $statusCode);
    }

    public static function error($statusCode = 0, $message, $data = null)
    {
        $statusCode = $statusCode == 0 ? Response::HTTP_INTERNAL_SERVER_ERROR : $statusCode;

        if($statusCode > Response::HTTP_NETWORK_AUTHENTICATION_REQUIRED) {
            $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        if (is_string($statusCode)) {
            $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
        }

        return response()->json([
            'Code' => $statusCode,
            'Message' => $message,
            'Data' => $data
        ], $statusCode);
    }
}
