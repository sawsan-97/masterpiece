<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // منتجات غذائية
        $foodCategory = Category::where('type', 'food')->first();
        if ($foodCategory) {
            $foodProducts = [
                [
                    'name' => 'لبنة بيتية بزيت زيتون',
                    'slug' => 'labneh-with-olive-oil',
                    'description' => 'لبنة طازجة محضرة على الطريقة المنزلية',
                    'price' => 5.99,
                    'stock' => 50,
                    'is_active' => true,
                ],
                [
                    'name' => 'مبخرة بالنعناع',
                    'slug' => 'mint-incense',
                    'description' => 'مبخرة تقليدية بالنعناع الطبيعي',
                    'price' => 8.99,
                    'stock' => 30,
                    'is_active' => true,
                ],
                [
                    'name' => 'ورق نعناع',
                    'slug' => 'mint-leaves',
                    'description' => 'نعناع مجفف طبيعي',
                    'price' => 3.99,
                    'stock' => 100,
                    'is_active' => true,
                ],
            ];

            foreach ($foodProducts as $product) {
                Product::create(array_merge($product, [
                    'category_id' => $foodCategory->id,
                ]));
            }
        }

        // منتجات حرفية
        $craftCategory = Category::where('type', 'craft')->first();
        if ($craftCategory) {
            $craftProducts = [
                [
                    'name' => 'شموع معطرة يدوية',
                    'slug' => 'handmade-scented-candles',
                    'description' => 'شموع طبيعية معطرة صناعة يدوية',
                    'price' => 12.99,
                    'stock' => 25,
                    'is_active' => true,
                ],
                [
                    'name' => 'مباخر نحاسية تراثية',
                    'slug' => 'copper-incense-burners',
                    'description' => 'مباخر تقليدية مصنوعة من النحاس',
                    'price' => 15.99,
                    'stock' => 20,
                    'is_active' => true,
                ],
                [
                    'name' => 'هدايا العيد',
                    'slug' => 'eid-gifts',
                    'description' => 'هدايا تقليدية مميزة لمناسبات العيد',
                    'price' => 25.99,
                    'stock' => 15,
                    'is_active' => true,
                ],
            ];

            foreach ($craftProducts as $product) {
                Product::create(array_merge($product, [
                    'category_id' => $craftCategory->id,
                ]));
            }
        }
    }
}
