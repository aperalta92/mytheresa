<?php

declare(strict_types=1);

namespace Mytheresa\Product\Domain\Resources;

class ProductsResponseResource
{
    public function __construct(
        public array $products,
    ) {
    }

    public function get(): self
    {
        return $this;
    }
}
