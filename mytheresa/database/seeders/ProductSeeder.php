<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    private array $data = [
        [
            "sku" => "000001",
            "name" => "BV Lean leather ankle boots",
            "category" => "boots",
            "discount_id" => null,
            "price" => 89000
        ],
        [
            "sku" => "000002",
            "name" => "BV Lean leather ankle boots",
            "category" => "boots",
            "discount_id" => null,
            "price" => 99000
        ],
        [
            "sku" => "000003",
            "name" => "Ashlington leather ankle boots",
            "category" => "boots",
            "discount_id" => null,
            "price" => 71000
        ],
        [
            "sku" => "000004",
            "name" => "Naima embellished suede sandals",
            "category" => "sandals",
            "discount_id" => null,
            "price" => 79500
        ],
        [
            "sku" => "000005",
            "name" => "Nathane leather sneakers",
            "category" => "sneakers",
            "discount_id" => null,
            "price" => 59000
        ]
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->data as $product) {
            $product['category_id'] = Category::where('name', '=', $product['category'])->first()->id();
            unset($product['category']);

            if ($product['sku'] === '000003') {
                $product['discount_id'] = Discount::where('percentage', '=', 15)->first()->id();
            }

            Product::create($product);
        }
    }
}
