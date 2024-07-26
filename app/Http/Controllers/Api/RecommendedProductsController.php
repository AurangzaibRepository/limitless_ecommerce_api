<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\RecommendedProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RecommendedProductsController extends Controller
{
    public function __construct(
        private RecommendedProductService $recommendedProductService
    ) {}

    /**
     * @OA\Get(
     *   path="/api/recommended-products",
     *   summary="Get recommended products",
     *        security={{"bearerAuth": {}}},
     *
     *   @OA\Response(response=200, description="Success")
     * )
     */
    public function get(Request $request): JsonResponse
    {
        $user = auth()->user();
        $data = $this->recommendedProductService->getRecommendedProducts($user->id);

        return generateResponse(
            'Success',
            null,
            null,
            $data,
            200
        );
    }
}
