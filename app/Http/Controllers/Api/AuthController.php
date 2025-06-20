<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Log;
use Exception;

class AuthController extends Controller
{
    use ApiResponseTrait;

    public function login(Request $request)
    {
        try {
            $data = $this->validateLogin($request);

            if (!Auth::attempt($data)) {
                return $this->sendError('Invalid email or password.', 401);
            }

            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            return $this->sendResponse([
                'token' => $token,
                'user' => $this->transformUser($user)
            ], 'Login successful.');

        } catch (ValidationException $e) {
            return $this->validationError($e->errors());

        } catch (Exception $e) {
            Log::error('Login Exception: ' . $e->getMessage());
            return $this->sendError('Something went wrong.', 500, ['error' => 'Server error']);
        }
    }

    protected function validateLogin(Request $request): array
    {
        return Validator::make($request->only('email', 'password'), [
            'email' => 'required|email',
            'password' => 'required|string|min:6'
        ])->validate();
    }
}
