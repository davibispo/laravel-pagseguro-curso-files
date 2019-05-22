<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Session;

class CartController extends Controller
{
    public function add($id)
    {
        $product = Product::find($id);
        if( !$product )
            return redirect()->back();
        
        $cart = new Cart;
        $cart->add($product);
        
        Session::put('cart', $cart);
        
        return redirect()->route('cart');
    }
    
    public function remove($id)
    {
        $product = Product::find($id);
        if( !$product )
            return redirect()->back();
        
        $cart = new Cart;
        $cart->remove($product);
        
        Session::put('cart', $cart);
        
        return redirect()->route('cart');
    }
}
