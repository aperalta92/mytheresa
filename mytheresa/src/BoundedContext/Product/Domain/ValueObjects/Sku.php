<?php

namespace Mytheresa\Product\Domain\ValueObjects;

final class Sku {

    public function __construct(
        private string $value
    ) {
    }

    public function value(): string
    {
        return $this->value;
    }
}
