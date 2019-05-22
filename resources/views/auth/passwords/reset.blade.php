@extends('store.layouts.main')

@section('content')
<div class="container text-center">
    <h1 class="title">Alterar Senha</h1>

    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif

    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
        {{ csrf_field() }}

        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email">E-Mail</label>

            <input id="email" type="email" class="form-control" placeholder="E-mail" name="email" value="{{ $email or old('email') }}" required autofocus>

            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password">Nova Senha</label>

            <input id="password" type="password" placeholder="Nova Senha" class="form-control" name="password" required>

            @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
            <label for="password-confirm">Confirmar Senha</label>
            <input id="password-confirm" type="password" placeholder="Confirmar Nova Senha" class="form-control" name="password_confirmation" required>

            @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
            @endif
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                Atualizar Senha
            </button>
        </div>
    </form>
</div>
@endsection
