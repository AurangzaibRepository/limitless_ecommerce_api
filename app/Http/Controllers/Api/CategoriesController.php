<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryAddRequest;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoriesController extends Controller
{
    public function __construct(
        private CategoryService $categoryService
    ) {}

    /**
     * @OA\Get(
     *   path="/api/categories/{id}",
     *   summary="Get category",
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
    public function get(CategoryRequest $request, int $id): JsonResponse
    {
        $data = $this->categoryService->getCategory($id);

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
     *      path="/api/categories",
     *      summary="Add category",
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
     *       ),
     *     ),
     *   ),
     *
     *   @OA\Response(response=201, description="Success")
     * )
     */
    public function add(CategoryAddRequest $request): JsonResponse
    {
        $data = $this->categoryService->addCategory($request->all());

        return generateResponse(
            'Success',
            'Category added successfully',
            null,
            $data,
            201
        );
    }

    /**
     * @OA\Put(
     *      path="/api/categories/{id}",
     *      summary="Update category",
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
     *       ),
     *     ),
     *   ),
     *
     *   @OA\Response(response=200, description="Success")
     * )
     */
    public function update(CategoryUpdateRequest $request, int $id): JsonResponse
    {
        $this->categoryService->updateCategory($id, $request->name);

        return generateResponse(
            'Success',
            'Category updated successfully',
            null,
            null,
            200
        );
    }
}
