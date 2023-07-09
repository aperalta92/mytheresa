<?php

declare(strict_types=1);

namespace Mytheresa\Category\Domain\Contracts;

use Mytheresa\Category\Domain\Entity\Category;

interface CategoryRepositoryContract
{
    public function find(int $id): ?Category;
}
