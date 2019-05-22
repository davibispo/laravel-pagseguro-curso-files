<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PagSeguro;
use App\Models\Order;
use App\Models\Cart;

class PagSeguroController extends Controller
{
    public function pagseguro(PagSeguro $pagseguro)
    {
        $code = $pagseguro->generate();
        
        $urlRedirect = config('pagseguro.url_redirect_after_request').$code;
        
        return redirect()->away($urlRedirect);
    }
    
    public function lightbox()
    {
        return view('pagseguro-lightbox');
    }
    
    public function lightboxCode(PagSeguro $pagseguro)
    {
        return $pagseguro->generate();
    }
    
    public function transparente()
    {
        return view('pagseguro-transparente');
    }
    
    public function getCode(PagSeguro $pagseguro)
    {
        return $pagseguro->getSessionId();
    }
    
    public function billet(Request $request, PagSeguro $pagseguro, Order $order)
    {
        $response = $pagseguro->paymentBillet($request->sendHash);
        
        $cart = new Cart;
        $order->newOrderProducts($cart, $response['reference'], $response['code']);
        $cart->emptyCart();
        
        return response()->json($response, 200);
    }
    
    public function card()
    {
        return view('pagseguro-transparent-card');
    }
    
    public function cardTransaction(Request $request, PagSeguro $pagseguro)
    {
        return $pagseguro->paymentCredCard($request);
    }
}