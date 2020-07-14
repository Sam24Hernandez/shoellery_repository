@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">                        
            <div class="widget-user-header text-white">                                               
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
                      <h5 class="description-header"><strong>Se unió:</strong></h5>
                      <span class="description-text">{{\FormatTime::LongTimeFilter($user->created_at)}}</span>
                    </div>
                  </div>
               
                  <div id="separator-right" class="col-sm-4 border-right">
                 
                  </div>
               
                  <div id="description-header-profile2" class="col-sm-4">
                    <div class="description-block">                        
                      <h5 class="description-header"><strong>Fotos</strong></h5>
                      <span class="description-text">{{count($user->images)}}</span>
                    </div>
       
                  </div>
              
                </div>
          
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

              @foreach($user->images as $image)
                 @include('includes.image',['image'=>$image])
              @endforeach                

        </div>
    </div>
</div>

@endsection
