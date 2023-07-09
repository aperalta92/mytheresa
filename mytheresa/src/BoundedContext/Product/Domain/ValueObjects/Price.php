<?php

namespace Mytheresa\Product\Domain\ValueObjects;

class Price {
    const CURRENCY = 'EUR';

    public function __construct(
        private int $value
    ) {
    }

    public function value(): int
    {
        return $this->value;
    }
}
