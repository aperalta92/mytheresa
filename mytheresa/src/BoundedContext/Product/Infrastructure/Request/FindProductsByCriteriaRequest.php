<?php

namespace Mytheresa\Product\Infrastructure\Request;

use Mytheresa\Product\Application\Contracts\FindProductsByCriteriaUseCaseRequestContract;

final class FindProductsByCriteriaRequest implements FindProductsByCriteriaUseCaseRequestContract
{
    public function __construct(
        private ?string $category,
        private ?int $priceLessThan,
    ) {
    }

    public function category(): ?string
    {
        return $this->category;
    }

    public function priceLessThan(): ?int
    {
        return $this->priceLessThan;
    }
}
