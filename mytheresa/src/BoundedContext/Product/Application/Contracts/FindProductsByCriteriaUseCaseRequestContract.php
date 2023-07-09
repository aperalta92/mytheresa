<?php

namespace Mytheresa\Product\Application\Contracts;

Interface FindProductsByCriteriaUseCaseRequestContract {
    public function __construct(?string $cateogry, ?int $priceLessThan, int $page);
    public function category(): ?string;
    public function priceLessThan(): ?int;
    public function page(): int;
}
