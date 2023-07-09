<?php

namespace Mytheresa\Product\Domain\Converters;

class ProductListConverters {
    public function __construct(
        private ProductConverter $productConverter,
    ) {
    }

    public function execute(array $products): array
    {
        return array_map(
            fn ($product) => $this->productConverter->execute($product),
            $products,
        );
    }
}
