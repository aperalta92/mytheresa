<?php

namespace Database\Seeders;

use App\Models\Discount;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    private array $data = [
        [
            'name' => 'boots',
            'discount_id' => null,
        ],
        [
            'name' => 'sandals',
            'discount_id' => null,
        ],
        [
            'name' => 'sneakers',
            'discount_id' => null,
        ]
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->data as $category) {
            if ($category['name'] === 'boots') {
                $category['discount_id'] = Discount::where('percentage', '=', 30)->first()->id();
            }

            Category::create($category);
        }
    }
}
