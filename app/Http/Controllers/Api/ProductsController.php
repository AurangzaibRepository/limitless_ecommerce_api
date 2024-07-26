<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductAddRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

class ProductsController extends Controller
{
    public function __construct(
        private ProductService $productService
    ) {}

    /**
     * @OA\Get(
     *   path="/api/products/{id}",
     *   summary="Get product",
     *   security={{"bearerAuth": {}}},
     *
     *   @OA\Parameter(
     *      name="id",
     *      in="path"
     *   ),
     *
     *   @OA\Response(response=200, description="Success")
     * )
     */
    public function get(ProductRequest $request, int $id): JsonResponse
    {
        $data = $this->productService->getProduct($id);

        return generateResponse(
            'Success',
            null,
            null,
            $data,
            200
        );
    }

    /**
     * @OA\Post(
     *      path="/api/products",
     *      summary="Add product",
     *      security={{"bearerAuth": {}}},
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
     *           property="name",
     *           type="string",
     *         ),
     *        @OA\Property(
     *           property="description",
     *           type="string",
     *         ),
     *        @OA\Property(
     *           property="price",
     *           type="double",
     *         ),
     *        @OA\Property(
     *           property="category_id",
     *           type="integer",
     *         ),
     *       ),
     *     ),
     *   ),
     *
     *   @OA\Response(response=201, description="Success")
     * )
     */
    public function add(ProductAddRequest $request): JsonResponse
    {
        $data = $this->productService->addProduct($request->all());

        return generateResponse(
            'Success',
            'Product added successfully',
            null,
            $data,
            201
        );
    }

    /**
     * @OA\Put(
     *      path="/api/products/{id}",
     *      summary="Update product",
     *      security={{"bearerAuth": {}}},
     *
     *      @OA\Parameter(
     *          name="id",
     *          in="path"
     *      ),
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
     *           property="name",
     *           type="string",
     *         ),
     *        @OA\Property(
     *           property="description",
     *           type="string",
     *         ),
     *        @OA\Property(
     *           property="price",
     *           type="double",
     *         ),
     *        @OA\Property(
     *           property="category_id",
     *           type="integer",
     *         ),
     *       ),
     *     ),
     *   ),
     *
     *   @OA\Response(response=201, description="Success")
     * )
     */
    public function update(ProductUpdateRequest $request, int $id): JsonResponse
    {
        $this->productService->updateProduct($id, $request->all());

        return generateResponse(
            'Success',
            'Product updated successfully',
            null,
            null,
            200
        );
    }

    /**
     * @OA\Delete(
     *   path="/api/products/{id}",
     *   summary="Delete product",
     *   security={{"bearerAuth": {}}},
     *
     *   @OA\Parameter(
     *      name="id",
     *      in="path"
     *   ),
     *
     *   @OA\Response(response=200, description="Success")
     * )
     */
    public function delete(ProductRequest $request, int $id): JsonResponse
    {
        $data = $this->productService->deleteProduct($id);

        return generateResponse(
            'Success',
            'Product deleted successfully',
            null,
            null,
            200
        );
    }
}
