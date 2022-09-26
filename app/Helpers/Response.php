<?php

use Illuminate\Http\JsonResponse;

//Success
/**
 * @param $message
 * @param $info
 * @return JsonResponse
 */
function success_response($data, $message="") : JsonResponse
{
    return response()->json([
        'success' => true,
        'message' => $message,
        'data' => $data,
    ], STATUS_CODE_SUCCESS);
}

//Error
/**
 * @param $message
 * @param $status
 * @return JsonResponse
 */
function failed_response($message, $status) : JsonResponse
{
    return response()->json([
        'success' => false,
        'message' => $message,
    ], $status);
}
