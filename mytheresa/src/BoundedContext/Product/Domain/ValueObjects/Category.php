<?php

namespace Mytheresa\Product\Domain\ValueObjects;

class Category {

    public function __construct(
        private ?string $value
    ) {
    }

    public function value(): ?string
    {
        return $this->value;
    }
}
