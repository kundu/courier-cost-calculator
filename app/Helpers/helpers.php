<?php

// app/helpers.php

if (!function_exists('apiResponse')) {
    function apiResponse(int $code = 200, string $message = "", $data = null)
    {
        return response()->json([
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}
