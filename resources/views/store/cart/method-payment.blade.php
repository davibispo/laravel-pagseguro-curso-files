@extends('store.layouts.main')

@section('content')
<h1 class="title">Escolha o meio de pagamento</h1>

<a href="#" id="payment-billet">
    <img src="{{url('assets/imgs/billet.png')}}" alt="Boleto" style="max-width: 100px;">
</a>

<div class="preloader" style="display: none;">
    <img src="{{url('assets/imgs/preloader.gif')}}" alt="Preloader" style="max-width: 50px;">
</div>
{!! Form::open(['id' => 'form']) !!}
{!! Form::close() !!}

@endsection

@push('scripts')
<!--URL PagSeguro Transparent-->
<script src="{{config('pagseguro.url_transparent_js')}}"></script>

<script>
    $(function(){
        $("#payment-billet").click(function(){
            setSessionId();
            
            $(".preloader").show();
            
            return false;
        });
    });
    
    function setSessionId()
    {
        var data = $('form#form').serialize();

        $.ajax({
            url: "{{route('pagseguro.code.transparent')}}",
            method: "POST",
            data: data
        }).done(function(data){
            console.log(data);
            PagSeguroDirectPayment.setSessionId(data);
            paymentBillet();
        }).fail(function(){
            $(".preloader").hide();
        }).always(function(){
            
        });
    }
    
    function paymentBillet()
    {
        var sendHash = PagSeguroDirectPayment.getSenderHash();

        var data = $('#form').serialize()+"&sendHash="+sendHash;

        $.ajax({
            url: "{{route('pagseguro.billet')}}",
            method: "POST",
            data: data
        }).done(function(data){
            console.log(data);
            
            if(data.success) {
                location.href=data.payment_link;
            } else {
                alert("Falha!");
            }
        }).fail(function(){
            alert("Fail request 2... :-(");
        }).always(function(){
            $(".preloader").hide();
        });
    }
</script>
@endpush