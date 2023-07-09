<?php

namespace Mytheresa\Product\Application\UseCases;

use Mytheresa\Product\Application\Contracts\FindProductsByCriteriaUseCaseRequestContract;
use Mytheresa\Product\Domain\Contracts\ProductRepositoryContract;
use Mytheresa\Product\Domain\Converters\ProductConverter;
use Mytheresa\Product\Domain\Converters\ProductListConverters;

final class FindProductsByCriteriaUseCase {
    public function __construct(
        private ProductRepositoryContract $repository,
    ) {
    }

    public function execute(FindProductsByCriteriaUseCaseRequestContract $request): array
    {
        $productListConverter = new ProductListConverters(new ProductConverter());
        return $productListConverter->execute(
            $this->repository->findByCriteria(
                $request->category(),
                $request->priceLessThan() * 100,
            )
        );
    }
}
