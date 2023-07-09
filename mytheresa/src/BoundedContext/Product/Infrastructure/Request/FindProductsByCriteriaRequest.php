<?php

namespace Mytheresa\Product\Infrastructure\Request;

use Mytheresa\Product\Application\Contracts\FindProductsByCriteriaUseCaseRequestContract;

class FindProductsByCriteriaRequest implements FindProductsByCriteriaUseCaseRequestContract
{
    public function __construct(
        private ?string $category,
        private ?int $priceLessThan,
        private int $page,
    ) {
    }

    public function page(): int
    {
        return $this->page;
    }

    public function category(): ?string
    {
        return $this->category;
    }

    public function priceLessThan(): ?int
    {
        if ($this->priceLessThan === null) {
            return null;
        }

        return $this->priceLessThan * 100;
    }
}
