<div class="card pub_image">
    <div class="card-header">

        @if($image->user->image)
        <div class="container-avatar">
            <a href="{{ route('profile', ['id' => $image->user->id])}}">
                <img src="{{ route('user.avatar', ['filename'=>$image->user->image]) }}" class="avatar">
            </a>
        </div>

        @else
        <div class="container-avatar">
            <a href="{{ route('profile', ['id' => $image->user->id])}}">
                <img src="{{ url('/img/user.png') }}" class="avatar">
            </a>
        </div>
        @endif

        <div id="data" class="data-user">
            <a href="{{ route('profile', ['id' => $image->user->id])}}">                
                <span class="nickname">
                    {{ '@'.$image->user->nick }}
                </span>
            </a>            
        </div>    

    </div>

    <div class="card-body">
        <div class="image-container">
            <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" />
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
            <img src="{{ asset('img/heart-red.png') }}" data-id="{{ $image->id }}" class="btn-dislike"/>
            @else
            <img src="{{ asset('img/heart-black.png') }}" data-id="{{ $image->id }}" class="btn-like"/>
            @endif 

        </div>
        <div class="comments">
            <a href="{{ route('image.detail', ['id' => $image->id]) }}" class="comment-button" title="Comentar">
                <i class="fa fa-comment fa-lg" aria-hidden="true"></i>
                <span class="number_likes_comments">{{count($image->comments)}}</span>
            </a>
        </div>

        <div class="view">
            <a href="{{ route('image.view', ['id' => $image->id]) }}" class="view-button" title="Ver Foto">
                <i class="fa fa-eye fa-lg" aria-hidden="true"></i>
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
                <span id="nickname" class="nickname">
                    {{'@'.$image->user->nick}}
                </span>
            </a> 
            <span class="nickname date">{{' | '.\FormatTime::LongTimeFilter($image->created_at)}}</span>
            <p>{{$image->description}}</p>
        </div>
    </div>
</div>


