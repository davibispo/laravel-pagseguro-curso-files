@extends('store.layouts.main')

@section('content')
<section class="products">
    <h1 class="title">LANÇAMENTOS</h1>
    
    @forelse($products as $product)
    <article class="product col-md-3 col-sm-6 col-xs-12">
        <img src="{{url("assets/imgs/temp/{$product->image}")}}" alt="">
        <h2>{{$product->name}}</h2>
        <a href="{{route('add.cart', $product->id)}}">Adicionar no Carrinho <i class="fa fa-cart-plus" aria-hidden="true"></i></a>
    </article>
    @empty
        <p>Não existem produtos cadastrados!</p>
    @endforelse

</section><!--Products-->
@endsection