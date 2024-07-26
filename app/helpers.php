<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

if (! function_exists('generateResponse')) {
    function generateResponse(
        string $status,
        ?string $message,
        ?array $errors,
        ?array $data,
        int $httpStatus
    ): JsonResponse {
        $response = [
            'status' => $status,
        ];

        if ($message !== null) {
            $response['message'] = $message;
        }

        if ($errors !== null) {
            $response['errors'] = $errors;
        }

        if ($data !== null) {
            $response['data'] = $data;
        }

        return response()->json($response, $httpStatus);
    }
}

if (! function_exists('hashPassword')) {
    function hashPassword(string $plainPassword)
    {
        return Hash::make($plainPassword);
    }
}
