<?php

declare(strict_types=1);

namespace Mytheresa\Product\Domain\Services;

use Mytheresa\Product\Domain\Contracts\ProductRepositoryContract;
use Mytheresa\Product\Domain\Converters\ProductConverter;

class GetProductsByCriteriaService
{
    public function __construct(
        private ProductRepositoryContract $productRepository,
        private ProductConverter $productConverter
    ) {
    }

    public function execute(
        ?string $category,
        ?int $priceLessThan,
        int $page,
    ): array {
        $products = $this->productRepository->findByCriteria($category, $priceLessThan, $page);

        $products['items'] = array_map(
            fn($product) => $this->productConverter->execute($product),
            $products['items']
        );

        return $products;
    }
}
