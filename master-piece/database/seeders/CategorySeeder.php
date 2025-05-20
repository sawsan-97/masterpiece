<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'منتجات غذائية بيتية',
                'slug' => 'home-food',
                'description' => 'منتجات غذائية طبيعية وبيتية عالية الجودة',
                'type' => 'food',
                'order' => 1,
                'is_active' => true
            ],
            [
                'name' => 'منتجات حرفية يدوية',
                'slug' => 'handmade-crafts',
                'description' => 'منتجات حرفية يدوية فريدة من نوعها',
                'type' => 'craft',
                'order' => 2,
                'is_active' => true
            ],
            [
                'name' => 'منتجات مميزة',
                'slug' => 'featured-products',
                'description' => 'منتجات مميزة وحصرية',
                'type' => 'food',
                'order' => 3,
                'is_active' => true
            ],
            [
                'name' => 'منتجات مخفضة',
                'slug' => 'discounted-products',
                'description' => 'منتجات بأسعار مخفضة',
                'type' => 'food',
                'order' => 4,
                'is_active' => true
            ],
            [
                'name' => 'منتجات رائجة',
                'slug' => 'trending-products',
                'description' => 'المنتجات الأكثر طلباً',
                'type' => 'craft',
                'order' => 5,
                'is_active' => true
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
