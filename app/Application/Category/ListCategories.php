<?php

namespace App\Application\Category;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

final class ListCategories
{
    public function __invoke(): Collection
    {
        return Category::all();
    }
}
