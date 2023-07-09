<?php

declare(strict_types=1);

namespace Mytheresa\Category\Infrastructure\Repositories;

use App\Models\Category as EloquentCategoryModel;
use Illuminate\Database\Eloquent\Builder;
use Mytheresa\Category\Domain\Entity\Category;
use Mytheresa\Category\Domain\Contracts\CategoryRepositoryContract;


class EloquentCategoryRepository implements CategoryRepositoryContract
{
    private EloquentCategoryModel $eloquentCategoryModel;

    public function __construct()
    {
        $this->eloquentCategoryModel = new EloquentCategoryModel;
    }

    private function query(): Builder
    {
        return $this->eloquentCategoryModel->query();
    }

    public function find(int $id): ?Category
    {
        $category = $this->query()->where('category_id', '=', $id)->first();

        if ($category === null) {
            return null;
        }

        $category = Category::create(
            $category->id(),
            $category->discountId(),
            $category->name(),
        );

        return $category;
    }
}
