@if(Auth::user() && Auth::user()->id == $image->user->id)
<div class="actions">            

    <button style="background: transparent!important;" type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">
        <i id="button-dark" class="fas fa-ellipsis-h" aria-hidden="true"></i>
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
                    Si borras esta foto nunca podrás recuperarla, ¿estás seguro de querer borrarla?
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

