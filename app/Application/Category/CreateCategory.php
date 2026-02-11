<?php

namespace App\Application\Category;

use App\Application\Category\DTOs\CategoryData;
use App\Models\Category;

final class CreateCategory
{
    public function __invoke(CategoryData $data): Category
    {
        return Category::create([
            'name' => $data->name,
            'description' => $data->description,
            'status' => $data->status,
        ]);
    }
}
