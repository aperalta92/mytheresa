<?php

declare(strict_types=1);

namespace Mytheresa\Discount\Domain\Entity;

use Mytheresa\Discount\Domain\ValueObjects\DiscountId;
use Mytheresa\Discount\Domain\ValueObjects\DiscountPercentage;

class Discount {

    public function __construct(
      private DiscountPercentage $percentage,
      private DiscountId $discountId
    ){
    }

    public function percentage(): DiscountPercentage
    {
        return $this->percentage;
    }

    public function discountId(): DiscountId
    {
        return $this->discountId;
    }

    public static function create(
        int $percentage,
        int $discountId,
    ): Discount
    {
        $discount = new self(
            new DiscountPercentage($percentage),
            new DiscountId($discountId)
        );

        return $discount;
    }
}
