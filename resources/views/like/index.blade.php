@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 id="title-likes" style="text-align: center;">Fotos Favoritas</h1>
            <hr/>
                        
            @foreach($likes as $like)
                @include('includes.image-card',['image'=>$like->image])
            @endforeach

            <!-- PAGINACION -->
            <div class="clearfix"></div>
            {{$likes->links()}}
        </div>
    </div>
</div>
@endsection
