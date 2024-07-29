<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->shareCartProductsCount();
    }

    private function shareCartProductsCount()
    {
        view()->composer('*', function ($view) {
            $cartProductsCount = $this->getCartProductsCount();
            $view->with('cartProductsCount', $cartProductsCount);
        });
    }

    private function getCartProductsCount()
    {
        // Si el usuario está autenticado, obtener el carrito y contar los productos
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            return $cart ? $cart->items->sum('quantity') : 0;
        }

        return 0; // Si no está autenticado, el conteo es 0
    }
}
