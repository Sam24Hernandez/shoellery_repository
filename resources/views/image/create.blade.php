@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            
            <div class="card">
                <div id="title-create" style="text-align: center; font-size: 20px; font-weight: bold;" class="card-header">
                    Nueva foto para la galería
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('image.save') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="image_path" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <!-- DRAG AND DROP FUNCTION -->
                                <input type="file" id="image_path" name="image_path" class="dropify" data-allowed-file-extensions="jpg png jpeg gif" data-max-file-size="5M" required/>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="description" class="col-sm-2 col-form-label">Descripción</label>
                            <div class="col-sm-10">                                
                                <textarea id="description" name="description" class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" placeholder="Escribe un pie de foto..." required></textarea>
                                @if($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Compartir</button>
                            </div>
                        </div>                          
                    </form>
                    
                </div>
            </div>
            
        </div>
    </div>
    
</div>
@endsection

@push('styles')
<!-- DRAG AND DROP FILE -->
<link rel="stylesheet" href="{{ asset('plugins/dropify.min.css') }}">
@endpush

@push('scripts')
<!-- jQuery file upload -->
<script src="{{ asset('js/dropify.min.js') }}"></script>
<!-- SCRIPTS DE INICIALIZACIÓN -->

<script type="text/javascript">
    $(document).ready(function($) {
        // Funcionalidades Básicas del Drop
        $('.dropify').dropify({           
            messages: {
            'default': 'Arrastra y suelta una foto aquí o haz clic',
            'replace': 'Arrastra y suelta o haz clic para reemplazar',
            'remove':  'Quitar',
            'error':   'Oops, sucedió algo malo.'
            }
        });
    });
</script>

@endpush
