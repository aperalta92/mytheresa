<?php

namespace Tests\Unit\Src\Product\Domain\Converters;

use Mytheresa\Product\Domain\Converters\ProductConverter;
use Mytheresa\Product\Domain\Converters\ProductListConverters;
use Mytheresa\Product\Domain\Entity\Product;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;

class ProductListConvertersTest extends TestCase
{
    private MockObject $productConverter;
    private ProductListConverters $sut;

    protected function setUp(): void
    {
        $this->productConverter = $this->createMock(ProductConverter::class);

        $this->sut = new ProductListConverters(
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

        $this->productConverter
            ->expects(self::once())
            ->method('execute')
            ->with($productEntity)
            ->willReturn( [
                "id" => 3,
                "sku" => "000003",
                "name" => "Ashlington leather ankle boots",
                "category" => "boots",
                "price" => [
                    "original" => 71000,
                    "final" => 49700,
                    "discountPercentage" => "30%",
                    "currency" => "EUR"
                ]
            ]);

        $productArray = [
            [
                "id" => 3,
                "sku" => "000003",
                "name" => "Ashlington leather ankle boots",
                "category" => "boots",
                "price" => [
                    "original" => 71000,
                    "final" => 49700,
                    "discountPercentage" => "30%",
                    "currency" => "EUR"
                ]
            ]
        ];

        $items = $this->sut->execute([$productEntity]);

        $this->assertEquals($productArray, $items);
    }
}
