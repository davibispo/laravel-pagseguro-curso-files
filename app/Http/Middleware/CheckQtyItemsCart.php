<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Cart;

class CheckQtyItemsCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $cart = new Cart;
        if ($cart->totalItems() < 1)
            return redirect()->back()->with('message', 'Não existe itens no carrinho!');
        
        return $next($request);
    }
}
