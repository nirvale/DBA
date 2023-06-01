<div class="">


  <div class="card" id="dependenciasdiv">
    <div class="card-body">
      <!-- Button trigger modal -->
      <button wire:click="limpiarInputs()" type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCrearDependencia">
        CREAR DEPENDENCIA
        <i class="fas fa-plus"></i>
      </button>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <div class="form-row ">
        <div class="form-group col-md-6">
          {{ Form::label('inputDependencia', 'DEPENDENCIAS')}}
          {{ Form::select('inputDependencia',  $dependenciasc ,null, ['class' => 'form-control select2','id' => 'inputDependencia','placeholder' => 'Todas las depedendencias...','wire:model'=>'selectDependencia'],) }}
        </div>
        <div class="form-group col-md-4">
            {{-- vacio --}}
        </div>
        <div class="form-group col-md-2">
          <label for=""> &nbsp;</label>
          <input wire:model="search"  class="form-control"  placeholder="buscar..."  >
        </div>
      </div>
    </div>

    <div class="card-body">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>CLAVE</th>
            <th>DEPENDENCIA</th>
            <th>ACCIÓN</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($dependencias as $dependencia)
            <tr>
              <td>{{$dependencia->cve_dependencia}}</td>
              <td>{{$dependencia->nombre}}</td>
              <td>
                <a href="javascript:void(0)" wire:click="editarDependencia('{{$dependencia->cve_dependencia}}')" id="editarDependencia" class="text-success"data-toggle="modal" data-target="#modalEditarDependencia"><i class="fas fa-edit"></i></a> &nbsp;
                <a href="javascript:void(0)" wire:click="eliminarDependencia('{{$dependencia->cve_dependencia}}')" id="eliminarDependencia" class="text-danger"><i class="fas fa-trash-alt"></i></a>

              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer col-12 d-flex justify-content-end pt-4" class="li: { list-style: none; }">
      {{ $dependencias->links() }}
    </div>
  </div>
@include('livewire.admin.creardependencia')
@include('livewire.admin.editardependencia')
</div>
