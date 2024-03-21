<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreatePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Interfaces\BaseAuthRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AuthController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth:sanctum', except: ['login', 'register', 'resetPassword', 'refreshToken', 'resend']),
        ];
    }
    /**
     * @var BaseAuthRepositoryInterface
     */
    private BaseAuthRepositoryInterface $authRepository;

    public function __construct(BaseAuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        return $this->authRepository->login($request->validated());
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        return $this->authRepository->register($data);
    }

    /**
     * @param CreatePasswordRequest $createPasswordRequest
     * @return JsonResponse
     */
    public function resetPassword(CreatePasswordRequest $createPasswordRequest): JsonResponse
    {
        return $this->authRepository->resetPassword($createPasswordRequest);
    }

    /**
     * resend
     * @param Request $request
     * @return JsonResponse
     */

    public function resend(Request $request): JsonResponse
    {
        $request->validate(['email' => 'required|email']);
        return $this->authRepository->resend($request->input('email'));
    }

    /**
     * update user data
     * @param UpdateProfileRequest $request
     * @return JsonResponse
     */
    public function update(UpdateProfileRequest $request): JsonResponse
    {
        return $this->authRepository->update($request->validated());
    }

    /**
     * Refresh Token
     * @param Request $request
     * @return JsonResponse
     */
    public function refreshToken(Request $request): JsonResponse
    {
        return $this->authRepository->refresh($request);
    }

    /**
     * Logout current device
     * @return JsonResponse
     */

    public function logout(): JsonResponse
    {
        return $this->authRepository->logout();
    }

    /**
     * Logout current device
     * @return JsonResponse
     */

    public function authenticatedUser(Request $request): JsonResponse
    {
        return $this->authRepository->authenticatedUser($request);
    }
}
