<?php

namespace Mytheresa\Product\Infrastructure\Repositories;

use App\Models\Product as EloquentModel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Mytheresa\Product\Domain\Contracts\ProductRepositoryContract;
use Mytheresa\Product\Domain\Entity\Product;

class EloquentProductRepository implements ProductRepositoryContract
{
    const MAX_PER_PAGE = 5;
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
            $eloquentModel->price(),
            $eloquentModel->categoryId(),
            $eloquentModel->discountId(),
            $eloquentModel->id(),
            null,
        );
    }

    public function findByCriteria(?string $category, ?int $priceLessThan, int $page): array
    {
        $query = $this->query();

        if ($category !== null) {
            $query->leftJoin('categories', 'products.category_id', '=', 'categories.category_id')
                ->where('category.name', '=', $category);
        }

        if ($priceLessThan !== null) {
            $query->where('price', '<=', $priceLessThan);
        }

        $eloquentProducts = new Paginator($query->get(), self::MAX_PER_PAGE, $page);

        $products = [
            'items' => [],
            'currPage' => $eloquentProducts->currentPage(),
        ];

        foreach ($eloquentProducts as $item) {
            $products['items'][] = Product::create(
                $item->sku(),
                $item->name(),
                $item->price(),
                $item->categoryId(),
                $item->discountId(),
                $item->id(),
                null,
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
            ->setCategoryId($product->categoryId()->value())
            ->setDiscountId($product->discountId()->value())
            ->setPrice($product->price()->value());

        $eloquentProduct->save();

        return Product::create(
            $eloquentProduct->sku(),
            $eloquentProduct->name(),
            $eloquentProduct->price(),
            $eloquentProduct->categoryId(),
            $eloquentProduct->discountId(),
            $eloquentProduct->id(),
            null,
        );
    }
}
