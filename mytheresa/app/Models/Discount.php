<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    /**
     * @var string
     */
    protected $table = 'discounts';

    /**
     * @var string
     */
    protected $id = 'discount_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'percentage',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    public function id(): int
    {
        return $this->getAttributeValue('discount_id');
    }

    public function setId(int $value): self
    {
        return $this->setAttribute('discount_id', $value);
    }

    public function percentage(): int
    {
        return $this->getAttributeValue('percentage');
    }

    public function setPercentage(int $value): self
    {
        return $this->setAttribute('percentage', $value);
    }
}
