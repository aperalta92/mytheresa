<?php

namespace Tests\Unit\Src\Product\Domain\Converters;

use Mytheresa\Category\Domain\Entity\Category;
use Mytheresa\Category\Domain\Services\GetCategoryByIdService;
use Mytheresa\Category\Domain\ValueObjects\CategoryId;
use Mytheresa\Category\Domain\ValueObjects\CategoryName;
use Mytheresa\Discount\Domain\ValueObjects\DiscountId;
use Mytheresa\Product\Domain\Converters\ProductConverter;
use Mytheresa\Product\Domain\Entity\Product;
use Mytheresa\Product\Domain\Resources\ProductPriceResponseResource;
use Mytheresa\Product\Domain\Resources\ProductResponseResource;
use Mytheresa\Product\Domain\Services\GetProductPriceService;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class ProductConverterTest extends TestCase
{
    private MockObject $getProductPriceService;
    private MockObject $getCategoryByIdService;
    private ProductConverter $sut;

    protected function setUp(): void
    {
        $this->getProductPriceService = $this->createMock(GetProductPriceService::class);
        $this->getCategoryByIdService = $this->createMock(GetCategoryByIdService::class);

        $this->sut = new ProductConverter(
            $this->getProductPriceService,
            $this->getCategoryByIdService,
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

        $categoryEntity = new Category(
            new CategoryId(1),
            new DiscountId(1),
            new CategoryName("boots")
        );

        $this->getCategoryByIdService
            ->expects(self::once())
            ->method('execute')
            ->with($productEntity->categoryId()->value())
            ->willReturn($categoryEntity);

        $priceResponseResource = new ProductPriceResponseResource(
            $productEntity->price()->value(),
            49700,
            '30%',
            'EUR',
        );

        $this->getProductPriceService
            ->expects(self::once())
            ->method('execute')
            ->with($productEntity)
            ->willReturn($priceResponseResource->get());

        $responseResource = new ProductResponseResource(
            $productEntity->id()->value(),
            $productEntity->sku()->value(),
            $productEntity->name()->value(),
            $categoryEntity->name()->value(),
            $priceResponseResource->get()
        );

        $items = $this->sut->execute($productEntity);

        $this->assertEquals($responseResource->toArray(), $items);
    }
}
