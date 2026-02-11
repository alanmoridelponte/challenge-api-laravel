<?php

namespace App\Application\Category;

use App\Domain\Exceptions\CategoryHasArticlesException;
use App\Models\Category;

final class DeleteCategory
{
    public function __invoke(Category $category): void
    {
        if ($category->articles()->exists()) {
            throw CategoryHasArticlesException::cannotDelete($category->name);
        }

        $category->delete();
    }
}
