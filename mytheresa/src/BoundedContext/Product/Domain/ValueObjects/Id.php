<?php

namespace Mytheresa\Product\Domain\ValueObjects;

final class Id {

    public function __construct(
        private ?int $value
    ) {
    }

    public function value(): ?int
    {
        return $this->value;
    }
}
