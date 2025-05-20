<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\JoinRequest;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer('layouts.admin', function ($view) {
            $pendingRequestsCount = JoinRequest::where('status', 'pending')->count();
            $view->with('pendingRequestsCount', $pendingRequestsCount);
        });

        View::composer('*', function ($view) {
            if (auth('web')->check()) {
                try {
                    $cart = Cart::where('user_id', auth('web')->id())->first();
                    if ($cart) {
                        $cartCount = DB::table('cart_items')
                            ->where('cart_id', $cart->id)
                            ->sum('quantity');
                    } else {
                        $cartCount = 0;
                    }
                    $view->with('cartCount', $cartCount);
                } catch (\Exception $e) {
                    $view->with('cartCount', 0);
                }
            }
        });
    }
}
