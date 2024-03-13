<?php

namespace App\Interfaces;


use App\Http\Requests\CreatePasswordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


interface BaseAuthRepositoryInterface
{
    /**
     * login user
     * @param $credentials
     * @return JsonResponse
     */
    public function login($credentials): JsonResponse;

    /**
     * register new user
     * @param $data
     * @return JsonResponse
     */
    public function register($data): JsonResponse;

    /**
     * update user data
     * @param $data
     * @return JsonResponse
     */

    public function update($data): JsonResponse;

    /**
     * @param CreatePasswordRequest $createPasswordRequest
     * @return JsonResponse
     */
    public function resetPassword(CreatePasswordRequest $createPasswordRequest): JsonResponse;
    /**
     * logout user
     * @return JsonResponse
     */
    public function logout(): JsonResponse;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function refresh(Request $request): JsonResponse;

    /**
     * @param string $email
     * @return JsonResponse
     */
    public function resend(string $email): JsonResponse;
}
