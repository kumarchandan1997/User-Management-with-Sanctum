<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Log;
use Exception;

class UserController extends Controller
{
    use ApiResponseTrait;

    public function show($id): JsonResponse
    {
        try {
            $user = User::with(['profile', 'addresses'])->find($id);

            if (!$user) {
                return $this->sendError('User not found', 404);
            }

            return $this->sendResponse([
                'user_name' => e($user->name),
                'mobile' => e($user->email),
                'dob' => $user->profile->dob ?? null,
                'gender' => $user->profile->gender ?? null,
                'Address' => $user->addresses->map(function ($address) {
                    return [
                        'address_type' => $address->address_type,
                        $address->address_type === 'home' ? 'address1' : 'address2' => $address->address_details,
                        'primary' => $address->primary,
                    ];
                })->values()
            ], 'User details');
        } catch (Exception $e) {
            Log::error('User Fetch Error: ' . $e->getMessage());
            return $this->sendError('Unable to fetch user details', 500, ['error' => 'Server error']);
        }
    }
}
