<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{

    /**
     * @var string
     */
    protected $table = 'categories';

    /**
     * @var string
     */
    protected $id = 'category_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'discount_id'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;


    public function id(): int
    {
        return $this->getAttributeValue('category_id');
    }

    public function setId(int $value): self
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

    public function name(): string
    {
        return $this->getAttributeValue('name');
    }

    public function setName(string $value): self
    {
        return $this->setAttribute('name', $value);
    }

    public function discount(): HasOne {
        return $this->hasOne(Discount::class, 'id', 'discount_id');
    }

    public function discountObj(): ?Discount
    {
        return $this->getRelationValue('discount');
    }

}
