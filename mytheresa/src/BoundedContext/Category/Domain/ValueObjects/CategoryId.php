<?php

declare(strict_types=1);

namespace Mytheresa\Category\Domain\ValueObjects;

class CategoryId
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
