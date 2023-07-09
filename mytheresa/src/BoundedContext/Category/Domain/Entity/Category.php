<?php

declare(strict_types=1);

namespace Mytheresa\Category\Domain\Entity;

use Mytheresa\Category\Domain\ValueObjects\CategoryId;
use Mytheresa\Category\Domain\ValueObjects\CategoryName;
use Mytheresa\Discount\Domain\ValueObjects\DiscountId;

class Category
{
    public function __construct(
        private CategoryId   $categoryId,
        private ?DiscountId  $discountId,
        private CategoryName $name,
    ) {
    }

    public function discountId(): ?DiscountId
    {
        return $this->discountId;
    }

    public function id(): CategoryId
    {
        return $this->categoryId;
    }

    public function name(): CategoryName
    {
        return $this->name;
    }

    public static function create(
        int   $categoryId,
        ?int  $discountId,
        string $name,
    ): Category {
        $category = new self(
            new CategoryId($categoryId),
            new DiscountId($discountId),
            new CategoryName($name),
        );

        return $category;
    }
}
