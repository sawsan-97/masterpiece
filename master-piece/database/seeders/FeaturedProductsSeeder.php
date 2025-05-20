<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class FeaturedProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إعادة تعيين جميع المنتجات ليست مميزة
        Product::query()->update(['is_featured' => false]);

        // تحديد أول 3 منتجات كمنتجات مميزة
        Product::query()
            ->where('is_active', true)
            ->take(3)
            ->update(['is_featured' => true]);

        $this->command->info('تم تحديد 3 منتجات كمنتجات مميزة بنجاح!');
    }
}
