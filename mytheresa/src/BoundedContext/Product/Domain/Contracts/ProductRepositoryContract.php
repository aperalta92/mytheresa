<?php

namespace Mytheresa\Product\Domain\Contracts;

use Mytheresa\Product\Domain\Entity\Product;

Interface ProductRepositoryContract
{
    public function find(Product $product): ?Product;
    public function findByCriteria(?string $category, ?int $priceLessThan, int $page): array;
    public function save(Product $product): Product;
}
