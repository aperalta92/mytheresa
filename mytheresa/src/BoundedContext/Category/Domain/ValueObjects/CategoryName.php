<?php

declare(strict_types=1);

namespace Mytheresa\Category\Domain\ValueObjects;

class CategoryName
{
    public function __construct(
        private string $value
    ) {
    }

    public function value(): string
    {
        return $this->value;
    }
}
