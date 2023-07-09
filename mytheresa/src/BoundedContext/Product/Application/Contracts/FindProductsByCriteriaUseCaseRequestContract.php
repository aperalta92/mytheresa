<?php

namespace Mytheresa\Product\Application\Contracts;

Interface FindProductsByCriteriaUseCaseRequestContract {
    public function __construct(?string $cateogry, ?int $priceLessThan);
    public function category(): ?string;
    public function priceLessThan(): ?int;
}
