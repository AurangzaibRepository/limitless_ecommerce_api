<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Info(
 *      title="Authentication APIs",
 *      version="1"
 * )
 */
class AuthController extends Controller
{
    public function __construct(
        private AuthService $authService
    ) {}

    /**
     * @OA\Post(
     *      path="/api/auth/register",
     *      summary="Register user",
     *
     *      @OA\RequestBody(
     *      required=true,
     *
     *      @OA\MediaType(
     *       mediaType="application/json",
     *
     *       @OA\Schema(
     *
     *         @OA\Property(
     *           property="first_name",
     *           type="string",
     *         ),
     *         @OA\Property(
     *           property="last_name",
     *           type="string",
     *         ),
     *         @OA\Property(
     *           property="email",
     *           type="string",
     *         ),
     *         @OA\Property(
     *           property="password",
     *           type="string",
     *         ),
     *       ),
     *     ),
     *   ),
     *
     *   @OA\Response(response=201, description="Success")
     * )
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $this->authService->register($request->all());

        return generateResponse(
            'Success',
            'User registered successfully',
            null,
            null,
            201
        );
    }

    /**
     * @OA\Post(
     *      path="/api/auth/login",
     *      summary="Login user",
     *
     *      @OA\RequestBody(
     *      required=true,
     *
     *      @OA\MediaType(
     *       mediaType="application/json",
     *
     *       @OA\Schema(
     *
     *         @OA\Property(
     *           property="email",
     *           type="string",
     *         ),
     *         @OA\Property(
     *           property="password",
     *           type="string",
     *         ),
     *       ),
     *     ),
     *   ),
     *
     *   @OA\Response(response=200, description="Success")
     * )
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $user = $this->authService->getUser($request->email);

        return generateResponse(
            'Success',
            null,
            null,
            $user,
            200
        );
    }
}
