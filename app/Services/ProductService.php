<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public function getProduct(int $id): array
    {
        $data = Product::with('category')->find($id);

        return $data->toArray();
    }

    public function addProduct(array $data): array
    {
        $data = Product::create($data);

        return $data->toArray();
    }

    public function updateProduct(int $id, array $data): void
    {
        Product::where('id', $id)
            ->update($data);
    }

    public function deleteProduct(int $id): void
    {
        Product::destroy($id);
    }
}
