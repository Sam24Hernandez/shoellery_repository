@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#edit" data-toggle="tab">Editar Perfil</a></li>
                        <li class="nav-item"><a class="nav-link" href="#password_change" data-toggle="tab">Cambiar Contraseña</a></li>                                                     
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="edit">
                            <!-- Editar Perfil -->
                            <form method="POST" action="{{ route('user.update') }}" class="form-horizontal" enctype="multipart/form-data" aria-label="Editar Perfil">                                                               
                                @csrf

                                <h1 class="user_name">{{Auth::user()->nick }}</h1>
                                <br>
                                @if(Auth::user()->image)
                                <div class="avatar-center">
                                    <img src="{{ route('user.avatar',['filename'=>Auth::user()->image]) }}" />
                                </div>
                                @else
                                <div class="avatar-center">
                                     <img src="{{ url('/img/user.png') }}" />
                                </div>                                   
                                @endif
                                <hr>
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" value="{{ Auth::user()->name }}" required autofocus>

                                        @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="surname" class="col-sm-2 col-form-label">Apellido</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="surname" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" id="surname" value="{{ Auth::user()->surname }}" required autofocus >
                                        @if ($errors->has('surname'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('surname') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nick" class="col-sm-2 col-form-label">Nombre de Usuario</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="nick" class="form-control{{ $errors->has('nick') ? ' is-invalid' : '' }}" id="nick" value="{{ Auth::user()->nick }}" required autofocus>
                                        @if ($errors->has('nick'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nick') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>                                

                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email</label>

                                    <div class="col-sm-10">
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ Auth::user()->email }}" required>

                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="bio" class="col-sm-2 col-form-label">Biografía</label>
                                    <div class="col-sm-10">                                
                                        <textarea id="bio" name="bio" class="form-control" placeholder="Escribe tu biografía...">{{ Auth::user()->bio }}</textarea>                                            
                                    </div>
                                </div>

                                <div class="form-group row">                                   
                                    <label for="image_path" class="col-sm-2 col-form-label">
                                        Avatar
                                    </label>                                        
                                    <div class="col-sm-10">                                                                                   
                                        <input id="image_path" type="file" class="form-control{{ $errors->has('image_path') ? ' is-invalid' : '' }}" name="image_path">                                      
                                        @if ($errors->has('image_path'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image_path') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                    </div>
                                </div>                                        
                            </form>
                            <!-- /.editar perfil -->                                                             
                        </div>
                                                
                        <div class="tab-pane" id="password_change">                                    
                            <!-- Cambiar Password -->
                            <form method="POST" action="{{ route('user.update-password') }}" class="form-horizontal">
                                @csrf
                                <div class="form-group row">
                                    <label for="new-password" class="col-sm-2 col-form-label">Contraseña anterior</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="current-password" class="form-control {{ $errors->has('current-password') ? ' is-invalid' : '' }}" id="current-password" required>
                                        @if ($errors->has('current-password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('current-password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div> 

                                <div class="form-group row">
                                    <label for="new-password" class="col-sm-2 col-form-label">Contraseña nueva</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="new-password" class="form-control {{ $errors->has('new-password') ? ' is-invalid' : '' }}" id="new-password" required>
                                        @if ($errors->has('new-password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('new-password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="new-password-confirm" class="col-sm-2 col-form-label">Confirmar contraseña nueva</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="new-password_confirmation" class="form-control {{ $errors->has('new-password_confirmation') ? ' is-invalid' : '' }}" id="new-password-confirm" required>
                                        <div class="input-group-append showPassword">
                                            <button id="show_password_confirmation" class="btn btn-primary" type="button">
                                                <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>                                                                 

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
                                    </div>
                                </div>
                            </form>
                            <!-- /.cambiar password -->
                        </div>               
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
    </div>
</div>

@endsection


