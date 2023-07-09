<?php

namespace Mytheresa\Discount\Domain\Services;

use Mytheresa\Discount\Domain\Contracts\DiscountRepositoryContract;
use Mytheresa\Discount\Domain\Entity\Discount;

class GetDiscountByIdService
{
    public function __construct(
      private DiscountRepositoryContract $discountRepositoryContract,
    ) {
    }

    public function execute(int $id): Discount
    {
        return $this->discountRepositoryContract->find($id);
    }
}
