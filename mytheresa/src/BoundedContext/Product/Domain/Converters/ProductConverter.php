<?php

namespace Mytheresa\Product\Domain\Converters;

use Mytheresa\Product\Domain\Entity\Product;

class ProductConverter
{
    public function execute(Product $product): array
    {
        return $product->toArray();
    }
}
