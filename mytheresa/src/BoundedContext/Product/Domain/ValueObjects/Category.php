<?php

namespace Mytheresa\Product\Domain\ValueObjects;

final class Category {

    public function __construct(
        private string $value
    ) {
    }

    public function value(): string
    {
        return $this->value;
    }
}
