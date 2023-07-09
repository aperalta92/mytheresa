<?php

namespace Tests\Unit\Src\Product\Domain\Services;

use Mytheresa\Category\Domain\Entity\Category;
use Mytheresa\Category\Domain\Services\GetCategoryByIdService;
use Mytheresa\Discount\Domain\Entity\Discount;
use Mytheresa\Discount\Domain\Services\GetDiscountByIdService;
use Mytheresa\Product\Domain\Entity\Product;
use Mytheresa\Product\Domain\Resources\ProductPriceResponseResource;
use Mytheresa\Product\Domain\Services\GetProductPriceService;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class GetProductPriceServiceTest extends TestCase
{
    private MockObject $getCategoryByIdService;
    private MockObject $getDiscountByIdService;
    private GetProductPriceService $sut;

    protected function setUp(): void
    {
        $this->getCategoryByIdService = $this->createMock(GetCategoryByIdService::class);
        $this->getDiscountByIdService = $this->createMock(GetDiscountByIdService::class);

        $this->sut = new GetProductPriceService(
            $this->getCategoryByIdService,
            $this->getDiscountByIdService,
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

        $categoryEntity = Category::create(
            1,
            1,
            "boots",
        );

        $discountEntity = Discount::create(
            30,
            1,
        );

        $this->getCategoryByIdService
            ->expects(self::once())
            ->method('execute')
            ->with($productEntity->categoryId()->value())
            ->willReturn($categoryEntity);

        $this->getDiscountByIdService
            ->expects(self::exactly(2))
            ->method('execute')
            ->with($productEntity->discountId()->value())
            ->willReturn($discountEntity);

        $priceResponseResource = new ProductPriceResponseResource(
            $productEntity->price()->value(),
            49700,
            '30%',
            'EUR',
        );

        $price = $this->sut->execute($productEntity);

        $this->assertEquals($priceResponseResource->get(), $price);
    }
}
