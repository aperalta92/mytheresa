<?php

namespace Mytheresa\Product\Infrastructure\Responses;

class FindProductsByCriteriaResponseResource
{
    public function __construct(
        private array $items,
        private int $page,
        private int $code,
    ) {
    }

    public function __invoke(): array
    {
        return [
            'items' => $this->items,
            'page' => $this->page,
            'code' => $this->code
        ];
    }
}
