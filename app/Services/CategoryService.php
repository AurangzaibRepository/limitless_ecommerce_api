<?php

namespace App\Services;

use App\Models\Category;

class CategoryService
{
    public function getCategory(int $id): array
    {
        $data = Category::find($id);

        return $data->toArray();
    }

    public function addCategory(array $data): array
    {
        $data = Category::create($data);

        return $data->toArray();
    }

    public function updateCategory(int $id, string $name): void
    {
        Category::where('id', $id)
            ->update([
                'name' => $name,
            ]);
    }
}
