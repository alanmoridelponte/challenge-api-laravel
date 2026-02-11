<?php

namespace App\Http\Controllers;

use App\Application\Category\CreateCategory;
use App\Application\Category\DeleteCategory;
use App\Application\Category\DTOs\CategoryData;
use App\Application\Category\ListCategories;
use App\Application\Category\UpdateCategory;
use App\Domain\Exceptions\CategoryHasArticlesException;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(ListCategories $listCategories): CategoryCollection
    {
        return new CategoryCollection($listCategories());
    }

    public function store(CategoryStoreRequest $request, CreateCategory $createCategory): CategoryResource
    {
        $data = new CategoryData(
            name: $request->name,
            description: $request->description,
            status: $request->status
        );

        $category = $createCategory($data);

        return new CategoryResource($category);
    }

    public function show(Category $category): CategoryResource
    {
        return new CategoryResource($category);
    }

    public function update(CategoryUpdateRequest $request, Category $category, UpdateCategory $updateCategory): CategoryResource
    {
        $data = new CategoryData(
            name: $request->name,
            description: $request->description,
            status: $request->status
        );

        $category = $updateCategory($category, $data);

        return new CategoryResource($category);
    }

    public function destroy(Category $category, DeleteCategory $deleteCategory): \Symfony\Component\HttpFoundation\Response
    {
        try {
            $deleteCategory($category);
        } catch (CategoryHasArticlesException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->noContent();
    }
}
