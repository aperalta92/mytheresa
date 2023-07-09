<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Product extends Model
{
    use HasFactory, Notifiable;

    /**
     * @var string
     */
    protected $table = 'products';

    /**
     * @var string
     */
   protected $id = 'product_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sku',
        'name',
        'category',
        'price',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public function id(): int
    {
        return $this->getAttributeValue('product_id');
    }

    public function setId(int $value): self
    {
        return $this->setAttribute('product_id', $value);
    }

    public function sku(): string
    {
        return $this->getAttributeValue('sku');
    }

    public function setSku(string $value): self
    {
        $this->setAttribute('sku', $value);
    }

    public function name(): string
    {
        return $this->getAttributeValue('name');
    }

    public function setName(string $value): self
    {
        return $this->setAttribute('name', $value);
    }

    public function categoryId(): int
    {
        return $this->getAttributeValue('category_id');
    }

    public function setCategoryId(int $value): self
    {
        return $this->setAttribute('category_id', $value);
    }
    public function discountId(): ?int
    {
        return $this->getAttributeValue('discount_id');
    }

    public function setDiscountId(?int $value): self
    {
        return $this->setAttribute('discount_id', $value);
    }

    public function price(): string
    {
        return $this->getAttributeValue('price');
    }

    public function setPrice(string $value): self
    {
        return $this->setAttribute('price', $value);
    }

    public function category(): HasOne {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function categoryObj(): Category
    {
        return $this->getRelationValue('category');
    }

    public function discount(): HasOne {
        return $this->hasOne(Discount::class, 'id', 'discount_id');
    }

    public function discountObj(): ?Discount
    {
        return $this->getRelationValue('discount');
    }
}
