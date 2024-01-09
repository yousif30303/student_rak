<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class BaseController extends Controller
{
    public function success( $data, $message='Success')
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message
        ],200);
    }

    public function error($message, $exception = false)
    {
        Log::channel('api')->error($message);
        $message = ($exception) ? (config('app.debug') ? $message : __('Internet Server Error! Please contact customer support')) : $message;
        return response()->json([
            'success' => false,
            'message' => $message
        ],400);
    }

    public function errorWithData($message, $data)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => $data
        ],400);
    }

    public function errorWithCode($message, $code)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'code' => $code
        ],400);
    }

    public function errorWithCodeAndData($message, $code, $data)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'code' => $code,
            'data' => $data
        ],400);
    }

}
