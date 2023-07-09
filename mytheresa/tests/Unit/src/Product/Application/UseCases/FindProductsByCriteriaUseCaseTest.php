<?php

namespace Tests\Unit\Src\Product\Application\UseCases;

use Mytheresa\Category\Domain\Services\GetCategoryByIdService;
use Mytheresa\Product\Application\UseCases\FindProductsByCriteriaUseCase;
use Mytheresa\Product\Domain\Converters\ProductListConverters;
use Mytheresa\Product\Domain\Entity\Product;
use Mytheresa\Product\Domain\Services\GetProductsByCriteriaService;
use Mytheresa\Product\Infrastructure\Request\FindProductsByCriteriaRequest;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class FindProductsByCriteriaUseCaseTest extends TestCase
{
    private MockObject $getProductsByCriteriaService;
    private MockObject $getCategoryByIdService;
    private MockObject $productListConverter;
    private FindProductsByCriteriaUseCase $sut;

    protected function setUp(): void
    {
        $this->getProductsByCriteriaService = $this->createMock(GetProductsByCriteriaService::class);
        $this->getCategoryByIdService = $this->createMock(GetCategoryByIdService::class);
        $this->productListConverter = $this->createMock(ProductListConverters::class);

        $this->sut = new FindProductsByCriteriaUseCase(
            $this->getProductsByCriteriaService,
            $this->getCategoryByIdService,
            $this->productListConverter,
        );
    }

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $productEntityArray = [
            Product::create(
                "000003",
                "Ashlington leather ankle boots",
                71000,
                1,
                2,
                1,
                "boots",
            )
        ];

        $productArray = [
            Product::create(
                "000003",
                "Ashlington leather ankle boots",
                71000,
                1,
                2,
                1,
                "boots",
            )
        ];

        $request = new FindProductsByCriteriaRequest('boots', 800, 1);

        $this->getProductsByCriteriaService
            ->expects(self::once())
            ->method('execute')
            ->with(
                $request->category(),
                $request->priceLessThan(),
                $request->page()
            )
            ->willReturn($productEntityArray);


        $items = $this->sut->execute($request);

        $this->assertEquals($productArray, $items);
    }
}
