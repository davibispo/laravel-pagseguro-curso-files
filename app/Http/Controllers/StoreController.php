<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Session;

class StoreController extends Controller
{
    public function index(Product $product)
    {
        $products = $product->all();
        
        return view('store.home.index', compact('products'));
    }
    
    
    public function cart()
    {
        $title = 'Meu Carrinho de Compras!';
        
        $cart = new Cart;
        
        $products = $cart->getItems();
        
        return view('store.cart.cart', compact('title', 'cart', 'products'));
    }
    
    
    public function methodPayment()
    {
        $title = 'Escolha o metodo de pagamento';
        
        return view('store.cart.method-payment', compact('title'));
    }
}
