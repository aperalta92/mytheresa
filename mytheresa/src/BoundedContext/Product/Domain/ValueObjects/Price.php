<?php

namespace Mytheresa\Product\Domain\ValueObjects;

final class Price {

    public function __construct(
        private int $value
    ) {
    }

    public function value(): int
    {
        return $this->value;
    }
}
