<?php

namespace Mytheresa\Product\Domain\Converters;

use Mytheresa\Category\Domain\Services\GetCategoryByIdService;
use Mytheresa\Product\Domain\Entity\Product;
use Mytheresa\Product\Domain\Resources\ProductResponseResource;
use Mytheresa\Product\Domain\Services\GetProductPriceService;

class ProductConverter
{
    public function __construct(
        private GetProductPriceService $getProductPriceService,
        private GetCategoryByIdService $getCategoryByIdService,
    ) {
    }

    public function execute(Product $product): array
    {
        return (new ProductResponseResource(
            $product->id()->value(),
            $product->sku()->value(),
            $product->name()->value(),
            $this->getCategoryByIdService->execute($product->categoryId()->value())->name()->value(),
            $this->getProductPriceService->execute($product),
        ))->toArray();
    }
}
