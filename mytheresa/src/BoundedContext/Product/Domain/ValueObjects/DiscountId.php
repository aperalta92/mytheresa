<?php

namespace Mytheresa\Product\Domain\ValueObjects;

class DiscountId {

    public function __construct(
        private ?int $value
    ) {
    }

    public function value(): ?int
    {
        return $this->value;
    }
}
