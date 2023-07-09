<?php

namespace Mytheresa\Product\Domain\ValueObjects;

class Name {

    public function __construct(
        private string $value
    ) {
    }

    public function value(): string
    {
        return $this->value;
    }
}
