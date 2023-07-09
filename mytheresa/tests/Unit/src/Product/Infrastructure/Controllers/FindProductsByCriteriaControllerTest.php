<?php

namespace Tests\Unit\Src\Product\Infrastructure\Controllers;

use Mytheresa\Product\Application\UseCases\FindProductsByCriteriaUseCase;
use Mytheresa\Product\Domain\Entity\Product;
use Mytheresa\Product\Infrastructure\Controllers\FindProductsByCriteriaController;
use Mytheresa\Product\Infrastructure\Request\FindProductsByCriteriaRequest;
use Mytheresa\Product\Infrastructure\Responses\FindProductsByCriteriaResponseResource;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class FindProductsByCriteriaControllerTest extends TestCase
{
    private MockObject $useCase;
    private FindProductsByCriteriaController $sut;

    protected function setUp(): void
    {
        $this->useCase = $this->createMock(FindProductsByCriteriaUseCase::class);

        $this->sut = new FindProductsByCriteriaController(
            $this->useCase,
        );
    }

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $productEntity = Product::create(
            "000003",
            "Ashlington leather ankle boots",
            71000,
            1,
            1,
            1,
            "boots",
        );

        $productsArray = [
            'items' => [$productEntity],
            'currPage' => 1,
        ];

        $request = new FindProductsByCriteriaRequest(
            'boots',
            80000,
            1
        );

        $this->useCase
            ->expects(self::once())
            ->method('execute')
            ->with($request)
            ->willReturn($productsArray);

        $responseResource = new FindProductsByCriteriaResponseResource(
            $productsArray['items'],
            $productsArray['currPage'],
            200,
        );

        $response = $this->sut->__invoke('boots', 80000, 1);

        $this->assertEquals($responseResource(), $response);
    }
}
