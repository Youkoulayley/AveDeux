@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif

    <div class="row">
        <div class="five wide column">
            <form class="ui form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <div class="field {{ $errors->has('username') ? ' error' : '' }}">
                    <label>Nom d'utilisateur</label>
                    <input name="username" placeholder="Nom d'utilisateur" type="text" value="{{ old('username') }}">

                    @if ($errors->has('username'))
                        <div class="ui red message">
                            <strong>{{ $errors->first('username') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="field {{ $errors->has('password') ? ' error' : '' }}">
                    <label>Mot de passe</label>
                    <input name="password" placeholder="Mot de passe" type="password" value="{{ old('password') }}">

                    @if ($errors->has('password'))
                        <div class="ui red message">
                            <strong>{{ $errors->first('password') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="field {{ $errors->has('remember') ? ' error' : '' }}">
                    <div class="ui checkbox">
                        <input type="checkbox" name="remember">
                        <label>Se souvenir de moi</label>
                    </div>

                    @if ($errors->has('remember'))
                        <div class="ui red message">
                            <strong>{{ $errors->first('remember') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="button-center">
                    <div class="ui large buttons">
                        <button class="ui positive button">Se connecter</button>
                        <div class="or"></div>
                        <a href="{{ url('/password/reset') }}">
                            <button class="ui negative button">Mot de passe oublié</button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
