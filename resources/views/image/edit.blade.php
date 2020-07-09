@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div style="text-align: center; font-size: 20px; font-weight: bold;" class="card-header">
                    Actualizar Foto
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('image.update') }}" enctype="multipart/form-data">
                        @csrf   
                        <input type="hidden" name="image_id" value="{{$image->id}}" />
                        <div class="form-group row">
                            <label for="image_path" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                @if($image->user->image)
                                <div class="avatar-center">
                                    <img src="{{ route('image.file',['filename' => $image->image_path]) }}" class="avatar"/>									
                                </div>
                                @endif
                                <input id="image_path" type="file" name="image_path" class="form-control {{ $errors->has('image_path') ? 'is-invalid' : '' }}" />

                                @if($errors->has('image_path'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image_path') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Descripción</label>
                            <div class="col-sm-10">
                                <textarea id="description" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" required>{{$image->description}}</textarea>

                                @if($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Actualizar Foto</button>
                            </div>
                        </div> 


                    </form>

                </div>
            </div>           
        </div>
    </div>
</div>

@endsection

