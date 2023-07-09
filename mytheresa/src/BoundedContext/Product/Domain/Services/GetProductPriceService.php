<?php

declare(strict_types=1);

namespace Mytheresa\Product\Domain\Services;

use Mytheresa\Category\Domain\Services\GetCategoryByIdService;
use Mytheresa\Discount\Domain\Services\GetDiscountByIdService;
use Mytheresa\Product\Domain\Entity\Product;
use Mytheresa\Product\Domain\Resources\ProductPriceResponseResource;
use Mytheresa\Product\Domain\ValueObjects\Price;

class GetProductPriceService
{
    public function __construct(
        private GetCategoryByIdService $getCategoryByIdService,
        private GetDiscountByIdService $getDiscountByIdService
    ) {
    }

    public function execute(Product $product): ProductPriceResponseResource
    {
        $discounts = [];

        if (!is_null($product->categoryId()->value())) {
            $category = $this->getCategoryByIdService->execute($product->categoryId()->value());

            if (!is_null($category->discountId()->value())) {
                $discounts[] = $this->getDiscountByIdService->execute($category->discountId()->value())->percentage()->value();
            }
        }

        if (!is_null($product->discountId()->value())) {
            $discounts[] = $this->getDiscountByIdService->execute($product->discountId()->value())->percentage()->value();
        }

        $discount = !empty($discounts) ? max($discounts) : null;
        $productPriceResponseResource = new ProductPriceResponseResource(
            $product->price()->value(),
            !empty($discounts) ? $this->applyPriceDiscount($product->price()->value(), $discount) : $product->price()->value(),
            !empty($discounts) ? "{$discount}%" : null,
            Price::CURRENCY,
        );

        return $productPriceResponseResource->get();

    }

    private function applyPriceDiscount(int $price, int $discount): int
    {
        return (int) round(($price * (100 - $discount)) / 100, 0);
    }
}
