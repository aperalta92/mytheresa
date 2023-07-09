<?php

declare(strict_types=1);

namespace Mytheresa\Discount\Domain\Contracts;

use Mytheresa\Discount\Domain\Entity\Discount;

interface DiscountRepositoryContract
{
    public function find(int $id): ?Discount;
}
