<?php

namespace Mytheresa\Category\Domain\Services;

use Mytheresa\Category\Domain\Contracts\CategoryRepositoryContract;
use Mytheresa\Category\Domain\Entity\Category;

class GetCategoryByIdService
{
    public function __construct(
      private CategoryRepositoryContract $categoryRepositoryContract,
    ) {
    }

    public function execute(int $id): Category
    {
        return $this->categoryRepositoryContract->find($id);
    }
}
