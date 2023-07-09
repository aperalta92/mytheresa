<?php

namespace Mytheresa\Product\Domain\Resources;

class ProductResponseResource
{
    public function __construct(
        public int $id,
        public string $sku,
        public string $name,
        public string $category,
        public ProductPriceResponseResource $price,
    ) {
    }

    public function get(): self
    {
        return $this;
    }

    public function toArray(): array
    {
        return json_decode(json_encode($this->get()), true);
    }
}
