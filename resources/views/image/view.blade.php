@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">         
        <div class="col-md-4">

            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                    <div class="text-center">
                        @if($image->user->image)
                        <a href="{{ route('profile', ['id' => $image->user->id])}}">
                            <img src="{{ route('user.avatar',['filename'=>$image->user->image]) }}" title="Artista" class="profile-user-img img-fluid img-circle" alt="Foto" />
                        </a>
                        @else                          
                        <a href="{{ route('profile', ['id' => $image->user->id])}}">
                            <img src="{{ url('/img/user.png') }}" title="Artista" class="profile-user-img img-fluid img-circle" alt="Foto" />
                        </a>
                        @endif                          
                    </div>

                    <h3 class="profile-username text-center">{{$image->user->name.' '.$image->user->surname}}</h3>

                    <p class="text-muted text-center">{{'@'.$image->user->nick}}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                      <li class="list-group-item">
                        <b>Fotos</b> <a class="float-right">{{ count($image->user->images) }}</a>
                      </li>
                      <li class="list-group-item">
                        <b>Likes</b> <a class="float-right">{{count($image->likes)}}</a>
                      </li>                          
                    </ul>

                    <a href="{{ route('profile', ['id' => $image->user->id])}}" class="btn btn-primary btn-block">
                        <strong>Ver Perfil</strong>
                    </a>
              </div>
           
            </div>  

            <div class="card card-primary">
              <div class="card-header">
                <h3 id="title-likes" class="card-title">INFO</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i> Biografía</strong>
               
                @if(!empty($image->user->bio))
                <p class="text-muted">
                  {{ $image->user->bio }}
                </p>
                @else
                <p class="text-muted">
                  No tiene biografía.
                </p>
                @endif

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Lugar</strong>

                <p class="text-muted">Malibu, California</p>
              </div>
              <!-- /.card-body -->
            </div>          

        
        </div>

        <div class="col-md-8">
            <div class="card">
              <div class="card-body">                        
                            
                    <div class="image-container el-card-avatar el-overlay-1">
                      <img src="{{ route('image.file',['filename' => $image->image_path]) }}" alt="Photo">
                      <div class="el-overlay">
                          <ul class="el-info">
                            <li>
                                <a class="btn default btn-outline image-popup-vertical-fit" href="{{ route('image.file',['filename' => $image->image_path]) }}">
                                    <i class="fas fa-search-plus" aria-hidden="true"></i>
                                </a> 
                            </li>                              
                          </ul>
                      </div>
                    </div>      
                </div>         
            </div>
        </div>

    </div>
</div>
@endsection

@push('styles')
<!-- Popup CSS -->
<link href="{{ asset('plugins/magnific-popup.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<!-- Magnific popup JavaScript -->
<script src="{{ asset('js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{ asset('js/jquery.magnific-popup-init.js')}}"></script>
@endpush


