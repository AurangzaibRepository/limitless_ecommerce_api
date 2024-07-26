<?php

namespace App\Services;

use App\Models\ProductAttribute;
use App\Models\ProductRating;

class RecommendedProductService
{
    public function getRecommendedProducts(int $userId): array
    {
        // Collaborative filtering
        return $this->getContentBasedFilteredProducts($userId);
    }

    private function getContentBasedFilteredProducts($userId): array
    {
        // Get user rated products
        $userRatedProducts = $this->getUserRatedProducts($userId);

        // Get similar products based on attributes
        $recommendedProducts = ProductAttribute::join('products', 'products.id', '=', 'product_attributes.product_id')
            ->whereNotIn('product_id', $userRatedProducts['productIds']) // Exclude user products
            ->whereIn('size', $userRatedProducts['sizes'])
            ->whereIn('color', $userRatedProducts['colors'])
            ->distinct()
            ->select('products.id', 'products.name')
            ->get();

        return $recommendedProducts->toArray();
    }

    private function getUserRatedProducts(int $userId): array
    {
        // Fetch user rated products attributes (with high ratings)
        $userProducts = ProductRating::join('product_attributes', 'product_ratings.product_id', '=', 'product_attributes.product_id')
            ->where('user_id', $userId)
            ->where('ratings', '>=', 4)
            ->select('product_attributes.*')
            ->distinct()
            ->get()
            ->toArray();

        // Get product ids and remove duplicate below in data array
        $userProductsIds = array_column($userProducts, 'product_id');

        $data = [
            'productIds' => array_unique($userProductsIds),
            'sizes' => array_column($userProducts, 'size'),
            'colors' => array_column($userProducts, 'color'),
        ];

        return $data;
    }
}
