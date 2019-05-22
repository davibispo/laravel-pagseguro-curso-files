@extends('store.layouts.main')

@section('content')
<h1 class="title">Meu Perfil</h1>

@if( session('message') )
<div class="alert alert-success">
    <p>{{session('message')}}</p>
</div>
@endif

@if( session('error') )
<div class="alert alert-danger">
    <p>{{session('error')}}</p>
</div>
@endif

@if(isset($errors) && $errors->any())
<div class="alert alert-danger">
    @foreach( $errors->all() as $error )
        <p>{{$error}}</p>
    @endforeach
</div>
@endif

{!! Form::open(['route' => 'profile.update']) !!}
    {{ csrf_field() }}

    <h4>Dados Pessoais:</h4>

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name">Name</label>

        <input id="name" type="text" class="form-control" name="name" placeholder="Nome" value="{{ auth()->user()->name }}" required autofocus>

        @if ($errors->has('name'))
        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email">E-Mail</label>

        <input id="email" type="email" class="form-control" name="email" placeholder="E-mail" value="{{ auth()->user()->email }}" disabled="disabled">

        @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
        @endif
    </div>


    <div class="form-group{{ $errors->has('cpf') ? ' has-error' : '' }}">
        <label for="name">CPF</label>

        <input id="cpf" type="text" class="form-control" name="cpf" placeholder="CPF" value="{{ auth()->user()->cpf }}" disabled="disabled">

        @if ($errors->has('cpf'))
        <span class="help-block">
            <strong>{{ $errors->first('cpf') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('birth_date') ? ' has-error' : '' }}">
        <label for="birth_date">Data Aniversário:</label>

        <input id="birth_date" type="date" class="form-control" name="birth_date" placeholder="Data de Aniversário:" value="{{ auth()->user()->birth_date }}" required>

        @if ($errors->has('birth_date'))
        <span class="help-block">
            <strong>{{ $errors->first('birth_date') }}</strong>
        </span>
        @endif
    </div>



    <h4>Endereço:</h4>

    <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
        <label for="street">Rua</label>

        <input id="street" type="text" class="form-control" name="street" placeholder="Rua:" value="{{ auth()->user()->street }}" required>

        @if ($errors->has('street'))
        <span class="help-block">
            <strong>{{ $errors->first('street') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">
        <label for="name">Número</label>

        <input id="number" type="text" class="form-control" name="number" placeholder="Número:" value="{{ auth()->user()->number }}" required>

        @if ($errors->has('number'))
        <span class="help-block">
            <strong>{{ $errors->first('number') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('complement') ? ' has-error' : '' }}">
        <label for="complement">Complemento:</label>

        <input id="complement" type="text" class="form-control" name="complement" placeholder="Complemento:" value="{{ auth()->user()->complement }}" required>

        @if ($errors->has('complement'))
        <span class="help-block">
            <strong>{{ $errors->first('complement') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('district') ? ' has-error' : '' }}">
        <label for="district">Bairro:</label>

        <input id="district" type="text" class="form-control" name="district" placeholder="Bairro:" value="{{ auth()->user()->district }}" required>

        @if ($errors->has('district'))
        <span class="help-block">
            <strong>{{ $errors->first('district') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('postal_code') ? ' has-error' : '' }}">
        <label for="postal_code">Código Postal:</label>

        <input id="postal_code" type="text" class="form-control" name="postal_code" placeholder="Código Postal (CEP):" value="{{ auth()->user()->postal_code }}" required>

        @if ($errors->has('postal_code'))
        <span class="help-block">
            <strong>{{ $errors->first('postal_code') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
        <label for="city">Cidade:</label>

        <input id="city" type="text" class="form-control" name="city" placeholder="Cidade:" value="{{ auth()->user()->city }}" required>

        @if ($errors->has('city'))
        <span class="help-block">
            <strong>{{ $errors->first('city') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
        <label for="state">Estado:</label>

        <input id="state" type="text" class="form-control" name="state" placeholder="Estado:" value="{{ auth()->user()->state }}" required>

        @if ($errors->has('state'))
        <span class="help-block">
            <strong>{{ $errors->first('state') }}</strong>
        </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
        <label for="country">País:</label>

        <input id="country" type="text" class="form-control" name="country" placeholder="País:" value="{{ auth()->user()->country }}" required>

        @if ($errors->has('country'))
        <span class="help-block">
            <strong>{{ $errors->first('country') }}</strong>
        </span>
        @endif
    </div>

    <h4>Telefone:</h4>

    <div class="form-group{{ $errors->has('area_code') ? ' has-error' : '' }}">
        <label for="area_code">Código de área:</label>

        <input id="area_code" type="text" class="form-control" name="area_code" placeholder="DDD:" value="{{ auth()->user()->area_code }}" required>

        @if ($errors->has('area_code'))
        <span class="help-block">
            <strong>{{ $errors->first('area_code') }}</strong>
        </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
        <label for="phone">Telefone:</label>

        <input id="phone" type="text" class="form-control" name="phone" placeholder="Telefone:" value="{{ auth()->user()->phone }}" required>

        @if ($errors->has('phone'))
        <span class="help-block">
            <strong>{{ $errors->first('phone') }}</strong>
        </span>
        @endif
    </div>



    <div class="form-group">
        <button type="submit" class="btn btn-primary">
            Atualizar Perfil
        </button>
    </div>
{!! Form::close() !!}

@endsection