@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">                        
            <div class="widget-user-header text-white">
                @if(Auth::user() && Auth::user()->id === $user->id)
                <div class="logout-action">
                    <button type="button" class="button-logout" data-toggle="modal" data-target="#myModal2">
                        <i class="fas fa-ellipsis-h" aria-hidden="true"></i>
                    </button>

                    <!-- The Modal -->
                    <div class="modal" id="myModal2">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 style="color: #262626;" class="modal-title">¿Quieres salir?</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div style="color: #262626;" class="modal-body">
                                    Regresa cuando quieras, y comparte con los demás siempre algo bueno.
                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                                    <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();" class="btn btn-danger">
                                     Cerrar Sesión
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <h3 class="widget-user-username text-right">{{$user->name .' '. $user->surname}}</h3>
                <h5 class="widget-user-desc text-right">{{'@'.$user->nick}}</h5>
                @if(Auth::user() && Auth::user()->id === $user->id)
                <a class="edit-profile" href="{{ route('config') }}">
                  <button type="button" class="btn btn-light">
                    Editar
                  </button>
                </a>                      
                @endif   
            </div> 
            @if($user->image)
            <div class="widget-user-image">
                <img class="img-circle elevation-2" src="{{ route('user.avatar',['filename'=>$user->image]) }}" />   
            </div>
            @else             
             <div class="widget-user-image">                
                <img class="img-circle elevation-2" src="{{ url('/img/user.png') }}" />   
            </div>
            @endif
            <div class="card-footer">
                <div class="row">
                  <div id="description-header-profile" class="col-sm-4 border-right">
                    <div class="description-block">
                      <h5 class="description-header">Se unió:</h5>
                      <span class="description-text">{{\FormatTime::LongTimeFilter($user->created_at)}}</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div id="separator-right" class="col-sm-4 border-right">
                    <div class="description-block">                                                                                                
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div id="description-header-profile2" class="col-sm-4">
                    <div class="description-block">                        
                      <h5 class="description-header">Fotos</h5>
                      <span class="description-text">{{count($user->images)}}</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            
            <div class="clearfix"></div>
            <hr>
            <div class="card-header">                
                  <button data-toggle="collapse" type="button" data-target="#collapseOne" role="button" class="btn btn-primary" aria-expanded="false" aria-controls="collapseOne">
                    Biografía
                </button>                
            </div>            
            <div id="collapseOne" class="collapse" style="">
                @if(!empty($user->bio))
                <div class="card-body">
                    {{ $user->bio }}
                    
                </div>
                @else
                <div class="card-body">                    
                    Aún no tiene una biografía.
                </div>
                @endif
            </div>
             <div class="clearfix"></div>
             <br>
            <div class="card">
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#gallery" data-toggle="tab"><i class="fa fa-object-group fa-lg" aria-hidden="true"></i> Mi Galería</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="gallery">
                            <!-- Perfil -->
                            @foreach($user->images as $image)
                            @include('includes.image',['image'=>$image])
                            @endforeach
                            <!-- /.perfil -->                                                             
                        </div>                                     
                    </div>                                        
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
            <div class="clearfix"></div>            
        </div>
    </div>
</div>
@stop
