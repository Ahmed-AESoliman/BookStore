<?php

namespace App\Repositories;

use App\Http\Requests\CreatePasswordRequest;
use App\Http\Resources\AuthenticatedUserResource;
use App\Http\Responses\ApiResponse;
use App\Interfaces\BaseAuthRepositoryInterface;
use App\Jobs\SendEmailJob;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

class BaseAuthRepository implements BaseAuthRepositoryInterface
{

    /**
     * Login User
     * @param $credentials
     * @return JsonResponse
     */
    public function login($credentials): JsonResponse
    {
        $user = User::where(['email' => $credentials['email'], 'is_active' => true])->first();
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return ApiResponse::error('incorrect Credentials');
        }
        return ApiResponse::success(
            new AuthenticatedUserResource($user, $user->createToken('access-token')->plainTextToken)
        );
    }

    /**
     * register new Merchant
     * @param $data
     * @return JsonResponse
     */
    public function register($data): JsonResponse
    {
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        if (!empty($user)) {
            // dispatch(new SendEmailJob($data['email']));
            return ApiResponse::success("Operation Done");
        }
        return ApiResponse::error();
    }

    /**
     * Update User Data
     * @param $data
     * @return JsonResponse
     */
    public function update($data): JsonResponse
    {
        $user = Auth::user();
        if (Hash::check($data['password'], $user->password)) {
            $user->update([
                'first_name' => $data['first_name'],
                'email' => $data['email'],
                'last_name' => $data['last_name'],
                'password' => isset($data['new_password']) ? Hash::make($data['new_password']) : $user->password,
                'mobile_number' => $data['mobile'],
                'avatar' => $data['avatar'] ?? $user->avatar,
            ]);
            return response()->json(new AuthenticatedUserResource(Auth::user(), null), 201);
        } else {
            return response()->json(['error' => 'Old password does not match'], 400);
        }
    }

    /**
     * @param CreatePasswordRequest $createPasswordRequest
     * @return JsonResponse
     * @throws ValidationException
     */
    public function resetPassword(CreatePasswordRequest $createPasswordRequest): JsonResponse
    {
        $status = Password::reset(
            $createPasswordRequest->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($createPasswordRequest) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response()->json(['message' => $status], 200);
        } else {
            throw ValidationException::withMessages([
                'email' => $status
            ]);
        }
    }

    /**
     * Refresh Token
     * @param Request $request
     * @return JsonResponse
     */
    public function refresh(Request $request): JsonResponse
    {
        if (empty($token = $request->header('Authorization'))) {
            return response()->json(['message' => 'Token is invalid'], 422);
        }

        $token = explode('Bearer ', $token);
        if (empty($token[1]) || empty($token = PersonalAccessToken::findToken($token[1]))) {
            return response()->json(['message' => 'Token is invalid'], 422);
        }
        $newToken = $token->tokenable->createToken('access-token')->plainTextToken;
        $token->delete();
        return ApiResponse::success(['access_token' => $newToken]);
    }

    /***
     * @param string $email
     * Resend Create Password Email
     * @return JsonResponse
     */

    public function resend(string $email): JsonResponse
    {
        dispatch(new SendEmailJob($email));
        return ApiResponse::success('messages success sent');
    }

    /***
     * Logout & Delete Token
     * @return JsonResponse
     */

    public function logout(): JsonResponse
    {
        Auth::user()->currentAccessToken()->delete();
        return ApiResponse::success(null);
    }
}