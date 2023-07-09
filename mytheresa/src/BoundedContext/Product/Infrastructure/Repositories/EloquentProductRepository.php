<?php

namespace Mytheresa\Product\Infrastructure\Repositories;

use App\Models\Product as EloquentModel;
use Illuminate\Database\Eloquent\Builder;
use Mytheresa\Product\Domain\Contracts\ProductRepositoryContract;
use Mytheresa\Product\Domain\Entity\Product;

final class EloquentProductRepository implements ProductRepositoryContract
{
    private EloquentModel $eloquentProductModel;

    public function __construct() {
        $this->eloquentProductModel = new EloquentModel();
    }

    private function query(): Builder
    {
        return $this->eloquentProductModel->query();
    }

    public function find(Product $product): ?Product
    {
        if ($product->id() === null) {
            return null;
        }

        $eloquentModel = $this->query()->where('product_id', '=', $product->id()->value())->first();

        return Product::create(
            $eloquentModel->sku(),
            $eloquentModel->name(),
            $eloquentModel->category(),
            $eloquentModel->price(),
            $eloquentModel->id()
        );
    }

    public function findByCriteria(?string $category, ?int $priceLessThan): array
    {
        $query = $this->query();

        if ($category !== null) {
            $query->where('category', '=', $category);
        }

        if ($priceLessThan !== null) {
            $query->where('price', '<', $priceLessThan);
        }

        $eloquentProducts = $query->get();

        $products = [];
        foreach ($eloquentProducts as $item) {
            $products[] = Product::create(
                $item->sku(),
                $item->name(),
                $item->category(),
                $item->price(),
                $item->id()
            );
        }

        return $products;
    }

    public function save(Product $product): Product
    {
        $eloquentProduct = $product->id() !== null ?
            $this->query()->where('product_id', $product->id()->value())->first() :
            $this->eloquentProductModel;

        $eloquentProduct
            ->setSku($product->sku()->value())
            ->setName($product->name()->value())
            ->setCategory($product->category()->value())
            ->setPrice($product->price()->value());

        $eloquentProduct->save();

        return Product::create(
            $eloquentProduct->sku(),
            $eloquentProduct->name(),
            $eloquentProduct->category(),
            $eloquentProduct->price(),
            $eloquentProduct->id(),
        );
    }
}
