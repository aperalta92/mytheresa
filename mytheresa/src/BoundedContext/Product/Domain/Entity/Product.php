<?php

namespace Mytheresa\Product\Domain\Entity;

use Mytheresa\Product\Domain\ValueObjects\Category;
use Mytheresa\Product\Domain\ValueObjects\Id;
use Mytheresa\Product\Domain\ValueObjects\Name;
use Mytheresa\Product\Domain\ValueObjects\Price;
use Mytheresa\Product\Domain\ValueObjects\Sku;

final class Product {

    public function __construct(
        private Sku $sku,
        private Name $name,
        private Category $category,
        private Price $price,
        private ?Id $id = null,
    ) {
    }

    public function sku(): Sku
    {
        return $this->sku;
    }

    public function setSku(Sku $sku): self
    {
        $this->sku = $sku;

        return $this;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function setName(Name $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function category(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function price(): Price
    {
        return $this->price;
    }

    public function setPrice(Price $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function id(): ?Id
    {
        return $this->id;
    }

    public function setId(?Id $id): self
    {
        $this->id = $id;

        return $this;
    }

    public static function create(
        string $sku,
        string $name,
        string $category,
        int $price,
        ?int $id,
    ): Product {
        return new self(
            new Sku($sku),
            new Name($name),
            new Category($category),
            new Price($price),
            new Id($id),
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
            'category' => $this->category()->value(),
            'price' => $this->price()->value(),
        ];
    }
}
