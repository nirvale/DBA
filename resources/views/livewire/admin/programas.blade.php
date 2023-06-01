<div class="">


  <div class="card" id="programasdiv">
    <div class="card-body">
      <!-- Button trigger modal -->
      <button wire:click="limpiarInputs()" type="button" class="btn btn-success" data-toggle="modal" data-target="#modalCrearPrograma">
        CREAR PROGRAMA
        <i class="fas fa-plus"></i>
      </button>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      <div class="form-row ">
        <div class="form-group col-md-6">
          {{ Form::label('inputDependencia', 'DEPENDENCIAS')}}
          {{ Form::select('inputDependencia',  $dependencias ,null, ['class' => 'form-control select2','id' => 'inputDependencia','placeholder' => 'Todas las depedendencias...','wire:model'=>'selectDependencia'],) }}
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
            <th>PROGRAMA</th>
            <th>ACCIÓN</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($programas as $programa)
            <tr>
              <td>{{$programa->cve_programa}}</td>
              <td>{{$programa->nombre}}</td>
              <td>{{$programa->programa}}</td>
              <td>
                <a href="javascript:void(0)" wire:click="editarPrograma('{{$programa->cve_programa}}')" id="editarPrograma" class="text-success"data-toggle="modal" data-target="#modalEditarPrograma"><i class="fas fa-edit"></i></a> &nbsp;
                <a href="javascript:void(0)" wire:click="eliminarPrograma('{{$programa->cve_programa}}')" id="eliminarPrograma" class="text-danger"><i class="fas fa-trash-alt"></i></a>

              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="card-footer col-12 d-flex justify-content-end pt-4" class="li: { list-style: none; }">
      {{ $programas->links() }}
    </div>
  </div>
@include('livewire.admin.crearprograma')
@include('livewire.admin.editarprograma')
</div>
