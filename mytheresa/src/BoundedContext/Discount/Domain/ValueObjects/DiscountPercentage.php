<?php

declare(strict_types=1);

namespace Mytheresa\Discount\Domain\ValueObjects;

class DiscountPercentage
{
    public function __construct(
        private int $value
    ) {
    }

    public function value(): int
    {
        return $this->value;
    }
}
