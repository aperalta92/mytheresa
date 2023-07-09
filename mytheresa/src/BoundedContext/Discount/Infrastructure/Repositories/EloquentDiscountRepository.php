<?php

declare(strict_types=1);

namespace Mytheresa\Discount\Infrastructure\Repositories;

use App\Models\Discount as EloquentDiscountModel;
use Illuminate\Database\Eloquent\Builder;
use Mytheresa\Discount\Domain\Entity\Discount;
use Mytheresa\Discount\Domain\Contracts\DiscountRepositoryContract;

class EloquentDiscountRepository implements DiscountRepositoryContract
{
    private EloquentDiscountModel $eloquentDiscountModel;

    public function __construct()
    {
        $this->eloquentDiscountModel = new EloquentDiscountModel;
    }

    private function query(): Builder
    {
        return $this->eloquentDiscountModel->query();
    }

    public function find(?int $id): ?Discount
    {
        $discount = $this->query()->where('discount_id', '=', $id)->first();

        if ($discount === null) {
            return null;
        }

        return Discount::create(
            $discount->percentage(),
            $discount->id()
        );
    }
}
