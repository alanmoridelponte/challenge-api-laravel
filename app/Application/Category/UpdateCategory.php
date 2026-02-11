<?php

namespace App\Application\Category;

use App\Application\Category\DTOs\CategoryData;
use App\Models\Category;

final class UpdateCategory
{
    public function __invoke(Category $category, CategoryData $data): Category
    {
        $category->update([
            'name' => $data->name,
            'description' => $data->description,
            'status' => $data->status,
        ]);

        return $category;
    }
}
