<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        ProductCategory::create([
            'category_name' => 'Sports',
        ]);
        ProductCategory::create([
            'category_name' => 'Daily',
        ]);
        ProductCategory::create([
            'category_name' => 'Accessoris',
        ]);
    }
}
