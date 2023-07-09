<?php

namespace Mytheresa\Product\Infrastructure\Controllers;

use Mytheresa\Product\Application\UseCases\FindProductsByCriteriaUseCase;
use Mytheresa\Product\Infrastructure\Repositories\EloquentProductRepository;
use Mytheresa\Product\Infrastructure\Request\FindProductsByCriteriaRequest;

final class FindProductsByCriteriaController
{
    public function __construct(
        private EloquentProductRepository $repository,
    ) {
    }

    public function __invoke(
        ?string $category,
        ?int $priceLessThan
    ) : ?array {
        $request = new FindProductsByCriteriaRequest(
            $category,
            $priceLessThan,
        );

        $useCase = new FindProductsByCriteriaUseCase($this->repository);
        $products = $useCase->execute($request);

        return $products;
    }
}
