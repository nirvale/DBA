<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalEditarPrograma">
  CREAR PROGRAMA
  <i class="fas fa-plus"></i>
</button> --}}

<!-- Modal -->
<div wire:ignore.self class="modal fade" id="modalEditarPrograma" tabindex="-1" role="dialog" aria-labelledby="modalEditarProgramaTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditarProgramaLongTitle">EDITAR PROGRAMA</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
{{-- Inicia forma --}}
        <form class="form-editarPrograma" id="form-editarPrograma" action="javascript:void(0);" method="PUT" enctype="multipart/form-data">
          @csrf
          <div class="container-fluid">
            <div class="from-group row col-md-12" id="modalc1">
              <div class="form-group col-md-12">
                {{ Form::label('cve_dependencia', 'DEPENDENCIA')}}
                {{ Form::select('cve_dependencia',  $dependencias ,null, ['class' => 'form-control select2','id' => 'cve_dependencia','placeholder' => 'SELECCIONA LA DEPENDENCIA...','wire:model'=>'cve_dependencia'],) }}
                @error('cve_dependencia') <span class="text-danger error">{{ $message }}</span>@enderror
              </div>
              <div class="form-group col-md-12 ml-auto">
                <label data-error="error" data-success="ok" for="sel">CLAVE DE PROGRAMA</label>
                <input style="text-transform:uppercase" value="" name="cve_programa" type="text" id="cve_programa" class="form-control validate" placeholder="Clave alfanumérica..." wire:model="cve_programa">
                @error('cve_programa') <span class="text-danger error">{{ $message }}</span>@enderror
              </div>
            </div>
            <div class="from-group row col-md-12" id="modalc2">
              <div class="form-group col-md-12 ml-auto">
                <label data-error="error" data-success="ok" for="sel">NOMBRE DEL PROGRAMA</label>
                <input style="text-transform:uppercase"  value="" name="programa" type="text" id="programa" class="form-control validate" placeholder="Nombre del programa..." wire:model="programa">
                @error('programa') <span class="text-danger error">{{ $message }}</span>@enderror
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button wire:click="cancelarPE()"type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button wire:click.prevent="actualizarPrograma()" type="button" class="btn btn-success ">Guardar Cambios</button>
      </div>
    </form>
{{-- Termina forma --}}
    </div>
  </div>
</div>
