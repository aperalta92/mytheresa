<?php

namespace Tests\Unit\Src\Product\Domain\Services;

use Mytheresa\Product\Domain\Converters\ProductConverter;
use Mytheresa\Product\Domain\Entity\Product;
use Mytheresa\Product\Domain\Resources\ProductPriceResponseResource;
use Mytheresa\Product\Domain\Resources\ProductResponseResource;
use Mytheresa\Product\Domain\Services\GetProductsByCriteriaService;
use Mytheresa\Product\Infrastructure\Repositories\EloquentProductRepository;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class GetProductsByCriteriaServiceTest extends TestCase
{
    private MockObject $productRepositoryContract;
    private MockObject $productConverter;
    private GetProductsByCriteriaService $sut;

    protected function setUp(): void
    {
        $this->productRepositoryContract = $this->createMock(EloquentProductRepository::class);
        $this->productConverter = $this->createMock(ProductConverter::class);

        $this->sut = new GetProductsByCriteriaService(
            $this->productRepositoryContract,
            $this->productConverter,
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
        ];

        $this->productRepositoryContract
            ->expects(self::once())
            ->method('findByCriteria')
            ->with(
                'boots',
                80000,
                1
            )
            ->willReturn($productsArray);

        $priceResponseResource = new ProductPriceResponseResource(
            $productEntity->price()->value(),
            49700,
            '30%',
            'EUR',
        );

        $responseResource = new ProductResponseResource(
            $productEntity->id()->value(),
            $productEntity->sku()->value(),
            $productEntity->name()->value(),
            "boots",
            $priceResponseResource->get()
        );

        $this->productConverter
            ->expects(self::once())
            ->method('execute')
            ->with($productEntity)
            ->willReturn($responseResource->toArray());

        $products = $this->sut->execute("boots", 80000, 1);

        $this->assertEquals(
            ['items' => [$responseResource->toArray()]],
            $products
        );
    }
}
