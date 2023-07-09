<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Mytheresa\Product\Infrastructure\Controllers\FindProductsByCriteriaController as InfrastructureController;

class FindProductsByCriteriaController extends Controller
{
    public function __construct(
        private InfrastructureController $findProductsByCriteriaController,
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse(
            $this->findProductsByCriteriaController->__invoke(
                $request->input('category'),
                $request->has('priceLessThan') ? (int) $request->input('priceLessThan') : null,
                $request->has('page') ? (int) $request->input('page') : 1,
            )
        );
    }
}
