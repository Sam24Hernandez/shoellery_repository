<div class="card">
    <div class="card-body">        
        <div class="image-card">                       
            <img class="card-img-top" style="object-fit: cover;" src="{{ route('image.file', ['filename' => $image->image_path]) }}">
            <div class="overlay">
                <div class="info-middle"><span style="position: relative; top: -3px;">{{ count($image->likes) }}</span> <i class="fa fa-heart fa-lg" aria-hidden="true"></i> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
                    <i style="position: relative; top: -1px;" class="fa fa-comment fa-lg" aria-hidden="true"></i> <span style="position: relative; top: -4px;">{{count($image->comments)}}</span> </div>
            </div>
        </div>              
                                  
        <br>    
        <div class="card-text">
            <a class="text-muted" href="{{ route('profile', ['id' => $image->user->id])}}">                
                {{'@'.$image->user->nick}}
            </a> 
            <span class="nickname date">{{' | '.\FormatTime::LongTimeFilter($image->created_at)}}</span>
            <p>{{$image->description}}</p>
        </div>
    </div>
</div>
<br>




