<?php

declare(strict_types=1);

namespace Mytheresa\Product\Domain\Resources;

class ProductPriceResponseResource
{
    public function __construct(
        public int $original,
        public int $final,
        public ?string $discountPercentage,
        public string $currency,
    ) {
    }

    public function get(): self
    {
        return $this;
    }

    public function toArray(): array
    {
        return json_decode(json_encode($this->get()), true);
    }
}
