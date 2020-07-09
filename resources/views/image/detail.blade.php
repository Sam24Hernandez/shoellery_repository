@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('includes.message')

            <div class="card pub_image pub_image_detail">
                <div class="card-header">
                    @if($image->user->image)
                    <div class="container-avatar">
                        <a href="{{ route('profile', ['id' => $image->user->id])}}">
                            <img src="{{ route('user.avatar',['filename'=>$image->user->image]) }}" class="avatar" />
                        </a>
                    </div>
                    @else
                    <div class="container-avatar">
                        <a href="{{ route('profile', ['id' => $image->user->id])}}">
                            <img src="{{ url('/img/user.png') }}" class="avatar" />
                        </a>
                    </div>
                    @endif
                    <div class="data-user">
                        <a href="{{ route('profile', ['id' => $image->user->id])}}">                            
                            <span class="nickname">
                                {{'@'.$image->user->nick}}
                            </span>
                        </a>
                    </div>
                    @if(Auth::user() && Auth::user()->id === $image->user->id)
                    <div class="actions">            

                        <button style="background: transparent!important;" type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">
                            <i class="fas fa-ellipsis-h" aria-hidden="true"></i>
                        </button>

                        <div class="modal fade" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Preferencias de Foto</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body">                            
                                        <a href="{{ route('image.edit', ['id' => $image->id]) }}" class="btn btn-primary btn-block">Editar Foto</a>
                                        <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#myDelete">Borrar Foto</button>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                       <div class="modal fade" id="myDelete">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    
                                    <div class="modal-header">
                                        <h4 class="modal-title">¿Estás seguro?</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>

                                 
                                    <div class="modal-body">
                                        Si eliminar esta foto nunca podrás recuperarla, ¿estás seguro de querer borrarla?
                                    </div>

                               
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                                        <a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-danger">Borrar definitivamente</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    @endif                    
                </div>

                <div class="card-body">
                    <div class="image-container image-detail">
                        <img style="object-fit: cover;" src="{{ route('image.file',['filename' => $image->image_path]) }}">
                    </div>
                    <div class="likes">
                        <!-- Comprobar si el usuario le dio like a la imagen -->
                        <?php $user_like = false; ?>
                        @foreach($image->likes as $like)
                        @if($like->user->id == Auth::user()->id)
                        <?php $user_like = true; ?>
                        @endif
                        @endforeach
                        @if($user_like)
                        <img src="{{asset('img/heart-red.png')}}" data-id="{{$image->id}}" class="btn-dislike" title="Ya no me gusta la foto"/>
                        @else
                        <img src="{{asset('img/heart-black.png')}}" data-id="{{$image->id}}" class="btn-like" title="Me gusta la foto"/>
                        @endif
                    </div>
                    <div class="comments">
                        <a href="{{ route('image.detail', ['id' => $image->id])}}" class="comment-button" title="Comentar">
                            <i class="fa fa-comment fa-lg" aria-hidden="true"></i>
                            <span class="number_likes_comments">{{count($image->comments)}}</span>
                        </a>
                    </div>
                    <div class="share">
                        <a href="#" class="share-button" title="Compartir">
                            <i class="fa fa-share fa-lg" aria-hidden="true"></i>
                        </a>
                    </div>            
                    <div class="likes-post">
                        <div class="view-like">
                            @if(count($image->likes) > 0) 
                            <button class="like-button">
                                <span class="number_likes">{{ count($image->likes) }} Me gusta</span>                   
                            </button>
                             @else                         
                            <button class="like-button" >
                                <span class="number_likes">Indicar que te gusta</span>                  
                            </button> 
                            @endif
                        </div>
                    </div>
                    <div class="description">
                        <a href="{{ route('profile', ['id' => $image->user->id])}}">
                            <span class="nickname">{{'@'.$image->user->nick}}</span>
                        </a>
                        <span class="nickname date">{{' | '.\FormatTime::LongTimeFilter($image->created_at)}}</span>
                        <p>{{$image->description}}</p>
                    </div> 
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <h4>Comentarios ({{ count($image->comments) }})</h4>
                        <hr>
                        <form method="POST" action="{{ route('comment.save') }}">
                            @csrf
                            <input type="hidden" name="image_id" value="{{$image->id}}" />
                            <p>
                                <textarea class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" name="content" placeholder="¿Qué opinas?"></textarea>
                                @if($errors->has('content'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                                @endif
                            </p>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Publicar</button>
                                </div>
                            </div> 
                        </form>
                        <hr>                       

                       @foreach($image->comments as $comment)

                        <div id="box" class="description">
                            <a href="{{ route('profile', ['id' => $comment->user->id])}}">
                                <span id="nick-comment" class="nickname">{{'@'.$comment->user->nick}} </span>
                            </a>
                            <span id="date-comment" class="nickname date">{{' | '.\FormatTime::LongTimeFilter($comment->created_at)}}</span>
                            <div class="comment_by_comments">
                                @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                <a href="{{ route('comment.delete', ['id' => $comment->id]) }}" style="cursor: pointer;" class="comment-button" title="Borrar comentario">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a> 
                                @endif
                            </div>                        
                             
                            <p>
                                {{ str_limit($comment->content, 150, '') }}
                                @if(strlen($comment->content) > 150)
                                <span id="dots">...</span>
                                <span id="more">{{ substr($comment->content, 150) }}
                                </span>                                
                                @endif                        
                                <button id="myBtn" class="show-button" type="button" onclick="ShowComment()">
                                     más
                                </button> 
                                <br/>                
                            </p> 
                                                
                        </div>
                                                
                        @endforeach                        
                                        
                    </div>
                </div>                
            </div>

        </div>
    </div>
</div>
@stop

@push('scripts')
<script>
    function ShowComment(){
        var dots = document.getElementById("dots");
        var moreContent = document.getElementById("more");
        var btnContent = document.getElementById("myBtn");

        if(dots.style.display === "none"){
            dots.style.display = "inline";
            btnContent.innerHTML = "más";
            moreContent.style.display = "none";
        }else{
            dots.style.display = "none";
            btnContent.innerHTML = "menos";
            moreContent.style.display = "inline";
        }
    }
        
</script>
@endpush

