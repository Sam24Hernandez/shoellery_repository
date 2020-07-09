@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div style="text-align: center; font-size: 20px; font-weight: bold;" class="card-header">{{ __('Registro') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">                           

                            <div class="col-md-12">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Nombre" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>                                         

                        <div class="form-group row">                           

                            <div class="col-md-12">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" placeholder="Apellidos" name="surname" value="{{ old('surname') }}" required autocomplete="surname">

                                @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">                           

                            <div class="col-md-12">
                                <input id="nick" type="text" class="form-control @error('nick') is-invalid @enderror" placeholder="Nombre de Usuario" name="nick" value="{{ old('nick') }}" required autocomplete="nick">

                                @error('nick')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">                            

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Contraseña" name="password" required autocomplete="new-password">                                
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-12">
                                <input id="password-confirm" type="password" class="form-control" placeholder="Confirmar contraseña" name="password_confirmation" required autocomplete="new-password">
                                <div class="input-group-append showPassword">
                                    <button id="show_password" class="btn btn-primary" type="button">
                                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Registrarte') }}
                                </button>
                            </div>
                        </div>                      
                    </form>                    
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-body">
                    <p class="p-register">¿Tienes una cuenta?
                        <a class="a-register" href="{{ route('login') }}" style="text-decoration: none;">
                            <span class="span-register">Inicia sesión</span>
                        </a>
                    </p>                    
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
