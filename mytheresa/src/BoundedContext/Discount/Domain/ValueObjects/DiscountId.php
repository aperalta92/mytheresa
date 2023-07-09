<?php

declare(strict_types=1);

namespace Mytheresa\Discount\Domain\ValueObjects;

class DiscountId
{
    public function __construct(
        private ?int $value
    ) {
    }

    public function value(): ?int
    {
        return $this->value;
    }
}
