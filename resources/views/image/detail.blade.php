@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">            

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
                    @include('includes.message')
                                   
                </div>

                <div class="card-body">
                    <div class="image-container image-detail">
                        <img src="{{ route('image.file',['filename' => $image->image_path]) }}">
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
                        <img src="{{asset('img/heart-red.png')}}" data-id="{{$image->id}}" class="btn-dislike" />
                        @else
                        <img src="{{asset('img/heart-black.png')}}" data-id="{{$image->id}}" class="btn-like" />
                        @endif
                        
                    </div>
                    <div class="comments">
                        <a href="{{ route('image.detail', ['id' => $image->id])}}" class="comment-button" title="Comentar">
                            <i class="fa fa-comment fa-lg" aria-hidden="true"></i>
                            <span class="number_likes_comments">{{count($image->comments)}}</span>
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
                            <span id="nickname" class="nickname">{{'@'.$image->user->nick}}</span>
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

                        <!--COMENTARIOS-->
                        @foreach($image->comments as $comment)
                        <div class="comment">
                            <a href="{{ route('profile', ['id' => $comment->user->id])}}">
                                <span id="nickname" class="nickname">{{ '@'.$comment->user->nick }}</span>
                            </a>
                            <span class="nickname date">{{ ' | ' .\FormatTime::LongTimeFilter($comment->created_at) }} </span>
                            <p>{{ $comment->content }}<br/>

                                @if (Auth::check() && ($comment->user_id === Auth::user()->id)) 
                                <a title="Borrar Comentario" href="{{ route('comment.delete', ['id' => $comment->id]) }}" class="btn btn-sm btn-trash">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                                @endif                                                                 

                                                              
                            </p>                                                        
                        </div>
                        @endforeach                        
                           
                    </div>
                </div>                
            </div>

        </div>
    </div>
</div>
@endsection


