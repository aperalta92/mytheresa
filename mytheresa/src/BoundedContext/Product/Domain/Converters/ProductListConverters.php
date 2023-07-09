<?php

namespace Mytheresa\Product\Domain\Converters;

final class ProductListConverters {
    public function __construct(
        private ProductConverter $productConverter,
    ) {
    }

    public function execute(array $products): array
    {
        return array_map(
            function ($product) {
                return $this->productConverter->execute($product);
            },
            $products,
        );
    }
}
