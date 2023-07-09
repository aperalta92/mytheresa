<?php

namespace Mytheresa\Product\Infrastructure\Controllers;

use Mytheresa\Product\Application\UseCases\FindProductsByCriteriaUseCase;
use Mytheresa\Product\Infrastructure\Request\FindProductsByCriteriaRequest;
use Mytheresa\Product\Infrastructure\Responses\FindProductsByCriteriaResponseResource;

class FindProductsByCriteriaController
{
    public function __construct(
        private FindProductsByCriteriaUseCase $useCase,
    ) {
    }

    public function __invoke(
        ?string $category,
        ?int $priceLessThan,
        ?int $page,
    ) : ?array {
        $request = new FindProductsByCriteriaRequest(
            $category,
            $priceLessThan,
            $page,
        );
        $products = $this->useCase->execute($request);

        $response = new FindProductsByCriteriaResponseResource($products['items'], $products['currPage'], 200);
        return $response();
    }
}
