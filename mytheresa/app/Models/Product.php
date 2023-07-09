<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public function id(): int
    {
        return $this->getAttributeValue('product_id');
    }

    public function setId(int $value): self
    {
        return $this->setAttribute('id', $value);
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

    public function category(): string
    {
        return $this->getAttributeValue('category');
    }

    public function setCategory(string $value): self
    {
        return $this->setAttribute('category', $value);
    }

    public function price(): string
    {
        return $this->getAttributeValue('price');
    }

    public function setPrice(string $value): self
    {
        return $this->setAttribute('price', $value);
    }
}
