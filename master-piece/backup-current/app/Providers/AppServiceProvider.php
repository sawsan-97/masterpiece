<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // مشاركة التصنيفات مع جميع صفحات الموقع
        View::composer('layouts.navbar', function ($view) {
            $categories = Category::where('is_active', true)->get();
            $view->with('categories', $categories);
        });
    }
}
