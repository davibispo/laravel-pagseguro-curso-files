<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Models\Order;

class UserController extends Controller
{
    public function profile()
    {
        $title = 'Meu Perfil';
        
        return view('store.user.profile', compact('title'));
    }
    
    public function profileUpdate(Request $request, User $user)
    {
        $this->validate($request, $user->rulesUpdateProfile());
        
        $dataForm = $request->all();
        
        if( isset($dataForm['email']) )
            unset($dataForm['email']);
        if( isset($dataForm['cpf']) )
            unset($dataForm['cpf']);
        
        $update = auth()->user()->profileUpdate($dataForm);
        
        if( $update )
            return redirect()->route('profile')->with('message', 'Perfil Atualizado Sucesso!');
        
        
        return redirect()->route('profile')->with('error', 'Falha ao atualizar!');
    }
    
    public function password()
    {
        $title = 'Minha Senha';
        
        return view('store.user.password', compact('title'));
    }
    
    public function passwordUpdate(Request $request)
    {
        $this->validate($request, ['password' => 'required|string|min:6|confirmed']);
        
        $update = auth()->user()->updatePassword($request->password);
        
        if( $update )
            return redirect()->route('password')->with('message', 'Senha Atualizada Sucesso!');
        
        
        return redirect()->route('password')->with('error', 'Falha ao atualizar!');
    }
    
    public function logout()
    {
        Auth::logout();
        
        return redirect()->route('home');
    }
    
    
    public function myOrders(Order $order)
    {
        $title = 'Meus Pedidos';
        
        $orders = $order->user()->get();
        
        return view('store.orders.orders', compact('title', 'orders'));
    }
    
    
    public function detailsOrder(Order $order, $reference)
    {
        $order = $order->user()->where('reference', $reference)->get()->first();
        if (!$order)
            return redirect()->back();
        
        $title = "Detalhes do pedido {$order->id}";
        
        $products = $order->products()->get();
        
        return view('store.orders.products', compact('title', 'order', 'products'));
    }
}
