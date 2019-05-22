<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    protected $fillable = ['user_id', 'reference', 'code', 'status', 'payment_method', 'date'];
    
    public function scopeUser($query)
    {
        return $query->where('user_id', auth()->user()->id);
    }
    
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_order')
                        ->withPivot('qty', 'price');
    }
    
    
    public function newOrderProducts($cart, $reference, $code, $status = 1, $paymentMethod = 2)
    {
        $order = $this->create([
            'user_id'           => auth()->user()->id,
            'reference'         => $reference,
            'code'              => $code,
            'status'            => $status,
            'payment_method'    => $paymentMethod,
            'date'              => date('Ymd'),
        ]);
        
        $productsOrder = [];
        $itemsCart = $cart->getItems();
        foreach ($itemsCart as $item){
            $productsOrder[$item['item']->id] = [
                'qty'   => $item['qtd'],
                'price' => $item['item']->price,
            ];
        }
        
        $order->products()->attach($productsOrder);
    }
    
    
    public function getStatus($status)
    {
        $statusA = [
            1 => 'Aguardando pagamento',
            2 => 'Em análise',
            3 => 'Paga',
            4 => 'Disponível',
            5 => 'Em disputa',
            6 => 'Devolvida',
            7 => 'Cancelada',
            8 => 'Debitado',
            9 => 'Retenção temporária',
        ];
        
        return $statusA[$status];
    }
    
    public function getMethodPayment($method)
    {
        $paymentsMethods = [
            1 => 'Cartão de crédito',
            2 => 'Boleto',
            3 => 'Débito online (TEF)',
            4 => 'Saldo PagSeguro',
            5 => 'Oi Paggo',
            7 => 'Depósito em conta',
        ];
        
        return $paymentsMethods[$method];
    }
    
    
    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
    
    
    public function getDateRefreshStatusAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }
    
    
    public function changeStatus($newStatus)
    {
        $this->status = $newStatus;
        $this->save();
    }
}
