<?php

namespace App\Http\Controllers\api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\api\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Summary of Login
     * @param \App\Http\Requests\api\LoginRequest $loginRequest
     * @throws \Exception
     * @return JsonResponse|mixed
     */
    public function Login(LoginRequest $loginRequest): JsonResponse
    {
        try {
            if (Auth::attempt($loginRequest->only('email', 'password'))) {
                $user = Auth::user();
                $expires = now()->addDays(3);
                $token = $user->createToken('admin-token', ['*'], $expires)->plainTextToken;
            
                return response()->json([
                    'message' => 'Login Success',
                    'email' => $user->email,
                    'token' => $token,
                    'expires_at' => $expires,
                ], 200);
            }else{
                throw new Exception("Invalid Credential", 401);
                
            }
        } catch (\Throwable $th) {
            //throw $th;
            return ResponseHelper::error($th->getMessage(), $th->getCode(), null);

        }
    }
}
