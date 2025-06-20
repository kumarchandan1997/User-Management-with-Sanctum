<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    /**
     * Send a success JSON response.
     */
    protected function sendResponse($data, string $message = 'Success', int $code = 200): JsonResponse
    {
        return response()->json([
            'status_code' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Send an error JSON response with optional error details.
     */
    protected function sendError(string $message = 'Error', int $code = 400, array $errors = null): JsonResponse
    {
        return response()->json([
            'status_code' => $code,
            'message' => $message,
            'errors' => $errors
        ], $code);
    }

    /**
     * Send a validation error response.
     */
    protected function validationError(array $errors, string $message = 'Validation failed', int $code = 422): JsonResponse
    {
        return $this->sendError($message, $code, $errors);
    }

    /**
     * Transform user data (you can customize further or use API Resources instead).
     */
    protected function transformUser($user): array
    {
        return [
            'id' => $user->id,
            'name' => e($user->name),
            'email' => e($user->email),
        ];
    }
}
