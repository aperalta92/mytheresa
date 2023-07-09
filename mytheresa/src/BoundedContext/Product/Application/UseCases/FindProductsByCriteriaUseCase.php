<?php

namespace Mytheresa\Product\Application\UseCases;

use Mytheresa\Category\Domain\Services\GetCategoryByIdService;
use Mytheresa\Product\Application\Contracts\FindProductsByCriteriaUseCaseRequestContract;
use Mytheresa\Product\Domain\Converters\ProductListConverters;
use Mytheresa\Product\Domain\Services\GetProductsByCriteriaService;

class FindProductsByCriteriaUseCase {
    public function __construct(
        private GetProductsByCriteriaService $getProductsByCriteriaService,
        private GetCategoryByIdService $getCategoryByIdService,
        private ProductListConverters $productListConverters,
    ) {
    }

    public function execute(FindProductsByCriteriaUseCaseRequestContract $request): array
    {
        $items = $this->getProductsByCriteriaService->execute(
            $request->category(),
            $request->priceLessThan(),
            $request->page(),
        );

        return $items;
    }
}
