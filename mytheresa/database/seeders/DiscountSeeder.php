<?php

namespace Database\Seeders;

use App\Models\Discount;
use Illuminate\Database\Seeder;

class DiscountSeeder extends Seeder
{
    private array $data = [
        [
            'percentage' => 15,
        ],
        [
            'percentage' => 30,
        ]
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->data as $discount) {
            Discount::create($discount);
        }
    }
}
