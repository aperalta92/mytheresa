<?php

namespace Mytheresa\Product\Domain\Entity;

use Mytheresa\Product\Domain\ValueObjects\Category;
use Mytheresa\Product\Domain\ValueObjects\CategoryId;
use Mytheresa\Product\Domain\ValueObjects\DiscountId;
use Mytheresa\Product\Domain\ValueObjects\Id;
use Mytheresa\Product\Domain\ValueObjects\Name;
use Mytheresa\Product\Domain\ValueObjects\Price;
use Mytheresa\Product\Domain\ValueObjects\Sku;

class Product {

    public function __construct(
        private Sku $sku,
        private Name $name,
        private Price $price,
        private CategoryId $categoryId,
        private ?DiscountId $discountId = null,
        private ?Id $id = null,
        private ?Category $category = null,
    ) {
    }

    public function sku(): Sku
    {
        return $this->sku;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function category(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?string $category): ?Category
    {
        $this->category = new Category($category);

        return $this->category();
    }

    public function categoryId(): CategoryId
    {
        return $this->categoryId;
    }

    public function discountId(): DiscountId
    {
        return $this->discountId;
    }

    public function price(): Price
    {
        return $this->price;
    }

    public function id(): ?Id
    {
        return $this->id;
    }

    public static function create(
        string $sku,
        string $name,
        int $price,
        int $categoryId,
        ?int $discountId,
        ?int $id,
        ?string $category,
    ): Product {
        return new self(
            new Sku($sku),
            new Name($name),
            new Price($price),
            new CategoryId($categoryId),
            new DiscountId($discountId),
            new Id($id),
            new Category($category),
        );
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id()->value(),
            'sku' => $this->sku()->value(),
            'name' => $this->name()->value(),
            'price' => $this->price()->value(),
            'categoryId' => $this->categoryId()->value(),
            'discountId' => $this->discountId()->value(),
            'category' => $this->category()->value(),
        ];
    }
}
