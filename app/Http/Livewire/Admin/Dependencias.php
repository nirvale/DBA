<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Dependencia;
use Livewire\WithPagination;
use DB;
use App\Traits\Admin\RoleOrPermissionSpatie;

class Dependencias extends Component
{
    use RoleOrPermissionSpatie;
    use WithPagination;
    public function __construct()
    {
      $this->handlePermission('Administrador de Base de Datos|DBA Junior|admin|adming');
    }
    protected $listeners = ['refreshComponent' => '$refresh'];

    protected $paginationTheme='bootstrap';
    //variables publicas para poder ser usadas en las vistas
    public $search = '', $selectDependencia='',$dependencia,$cve_dependencia2,$cve_dependencia,$cve_dependencia_old;

    public function UpdatingSearch(){

      $this->resetPage();

    }
    public function UpdatingSelectDependencia(){

      $this->resetPage();

    }

    public function render()
    {

            $dependencias=Dependencia::where('nombre', 'like' , '%'. strtoupper($this->search) .'%')
              //->join('dependencias','dependencias.cve_dependencia','=','dependencias.cve_dependencia')
              ->when($this->selectDependencia,
                function($query,$selectDependencia){
                  return $query->where('dependencias.cve_dependencia',$selectDependencia);
                }
              )
              ->orderBy('nombre')
              //->orderBy('dependencia', 'asc')
              ->paginate();

        $dependenciasc = Dependencia::pluck('nombre','cve_dependencia');

        return view('livewire.admin.dependencias',compact('dependencias','dependenciasc'),['info'=>null]);
    }


    public function limpiarInputs()
    {
      $this->resetValidation();
      $this->cve_dependencia='';
      $this->cve_dependencia2='';
      $this->cve_dependencia_old='';
      $this->dependencia='';
    }

    public function guardarDependencia()
    {
      $validated = $this->validate([
        'cve_dependencia2' => 'required|unique:dependencias,cve_dependencia',
        'dependencia' => 'required|unique:dependencias,nombre',
      ]);
      DB::beginTransaction();
      try {
      $dependencia = Dependencia::create([

          'cve_dependencia'=> strtoupper($this->cve_dependencia2),
          'nombre'=> strtoupper($this->dependencia),
        ]);
        DB::commit();
        session()->flash('info', 'Se creo correctamente la dependencia: '.strtoupper($this->dependencia));
        $this->emit('dependenciaGuardado',(strtoupper($this->dependencia))); // Close model to using to jquery

      } catch (\Exception $e) {
          DB::rollBack();
          session()->flash('info', 'Error en la creación.');
          $this->emit('errorGuardandoDependencia',$e->getMessage(),strtoupper($this->dependencia));
       }
      $this->limpiarInputs();
      $this->emit('refreshComponent');
    }
  public function cancelarPE()
  {
    $this->limpiarInputs();
  }
  public function editarDependencia($cve_dependencia)
  {
    $this->limpiarInputs();

    $dependencia=Dependencia::findOrFail($cve_dependencia);
    //dd($dependencia);
    if (isset($dependencia)) {
      $this->cve_dependencia=$dependencia->cve_dependencia;
      $this->dependencia=$dependencia->nombre;
      $this->cve_dependencia_old=$dependencia->cve_dependencia;
    }
  }
  public function actualizarDependencia()
  {
    $validated = $this->validate([
      'cve_dependencia' => 'required',
      'dependencia' => 'required',
    ]);

    $pcheck=Dependencia::find($this->cve_dependencia);
    $pcheck2=Dependencia::where('nombre',$this->dependencia)->get();

      $cveo=strtoupper($this->cve_dependencia_old);
      $cven=strtoupper($this->cve_dependencia);

    if (isset($pcheck->cve_dependencia)  & ($cveo != $cven)) {

      session()->flash('info', 'La dependencia con clave:'.$cven.' ya existe, verifíquelo o contacte al administrador...');
      $this->emit('cveDependenciaExistente',$cveo,$pcheck);
    }elseif(isset($pcheck2[0]->cve_dependencia) & ($cveo == $cven )) {

      session()->flash('info', 'La dependencia con nombre:'.strtoupper($this->dependencia).' ya existe, verifíquelo o contacte al administrador...');
      $this->emit('DependenciaExistente',$cveo,$pcheck2);
    }else {

      DB::beginTransaction();
      try {
        $dependencia=Dependencia::find($cveo);
        $dependencia->cve_dependencia=strtoupper($this->cve_dependencia);
        $dependencia->nombre=strtoupper($this->dependencia);
        $dependencia->push();

        DB::commit();
        session()->flash('info', 'Se actualizó correctamente la dependencia: '.strtoupper($this->dependencia));
        $this->emit('dependenciaActualizado',(strtoupper($this->dependencia))); // Close model to using to jquery

      } catch (\Exception $e) {
        DB::rollBack();
        session()->flash('info', 'Error en la edición, contacte al administrador.');
        $this->emit('errorEditandoDependencia',$e->getMessage(),strtoupper($this->dependencia));
      }
      $this->limpiarInputs();
      $this->emit('refreshComponent');

    }
  }
  public function eliminarDependencia($cve_dependencia)
  {
    //dd($cve_dependencia);

    DB::beginTransaction();
    try {
      $dependencia=Dependencia::where('cve_dependencia',$cve_dependencia)->get();

      Dependencia::where('cve_dependencia',$cve_dependencia)->delete();
      session()->flash('info', 'Se elimnó correctamente la dependencia: '.$dependencia[0]->nombre);
      $this->emit('dependenciaEliminado',($dependencia[0]->nombre)); // Close model to using to jquery
      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      session()->flash('info', 'Error eliminando dependencia, contacte al administrador.');
      $this->emit('errorEliminandoDependencia',$e->getMessage(),$dependencia[0]->nombre);
    }
    $this->limpiarInputs();
    $this->emit('refreshComponent');
  }


}
