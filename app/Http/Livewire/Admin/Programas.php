<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Programa;
use App\Models\Dependencia;
use Livewire\WithPagination;
use DB;
use App\Traits\Admin\RoleOrPermissionSpatie;



class Programas extends Component
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
    public $search = '', $selectDependencia='',$programa,$cve_dependencia,$cve_programa,$cve_programa_old;

    public function UpdatingSearch(){

      $this->resetPage();

    }
    public function UpdatingSelectDependencia(){

      $this->resetPage();

    }

    public function render()
    {

            $programas=Programa::where('programa', 'like' , '%'. strtoupper($this->search) .'%')
              ->join('dependencias','dependencias.cve_dependencia','=','programas.cve_dependencia')
              ->when($this->selectDependencia,
                function($query,$selectDependencia){
                  return $query->where('programas.cve_dependencia',$selectDependencia);
                }
              )
              ->orderBy('nombre')
              ->orderBy('programa', 'asc')
              ->paginate();

        $dependencias = Dependencia::pluck('nombre','cve_dependencia');

        return view('livewire.admin.programas',compact('programas','dependencias'),['info'=>null]);
    }


    public function limpiarInputs()
    {
      $this->resetValidation();
      $this->cve_programa='';
      $this->cve_programa_old='';
      $this->cve_dependencia='';
      $this->programa='';
    }

    public function guardarPrograma()
    {
      $validated = $this->validate([
        'cve_dependencia' => 'required',
        'cve_programa' => 'required|unique:programas,cve_programa',
        'programa' => 'required|unique:programas,programa',
      ]);
      DB::beginTransaction();
      try {
      $programa = Programa::create([
          'cve_dependencia'=>strtoupper($this->cve_dependencia),
          'cve_programa'=> strtoupper($this->cve_programa),
          'programa'=> strtoupper($this->programa),
        ]);
        DB::commit();
        session()->flash('info', 'Se creo correctamente el programa: '.strtoupper($this->programa));
        $this->emit('programaGuardado',(strtoupper($this->programa))); // Close model to using to jquery

      } catch (\Exception $e) {
          DB::rollBack();
          session()->flash('info', 'Error en la creación.');
          $this->emit('errorGuardandoPrograma',$e->getMessage(),strtoupper($this->programa));
       }
      $this->limpiarInputs();
      $this->emit('refreshComponent');
    }
  public function cancelarPE()
  {
    $this->limpiarInputs();
  }
  public function editarPrograma($cve_programa)
  {
    $this->limpiarInputs();

    $programa=Programa::findOrFail($cve_programa);
    //dd($programa);
    if (isset($programa)) {
      $this->cve_programa=$programa->cve_programa;
      $this->cve_dependencia=$programa->cve_dependencia;
      $this->programa=$programa->programa;
      $this->cve_programa_old=$programa->cve_programa;
    }
  }
  public function actualizarPrograma()
  {
    $validated = $this->validate([
      'cve_dependencia' => 'required',
      'cve_programa' => 'required',
      'programa' => 'required',
    ]);

    $pcheck=Programa::find($this->cve_programa);
    $pcheck2=Programa::where('programa',$this->programa)->get();

      $cveo=strtoupper($this->cve_programa_old);
      $cven=strtoupper($this->cve_programa);

    if (isset($pcheck->cve_programa)  & ($cveo != $cven)) {

      session()->flash('info', 'El programa con clave:'.$cven.' ya existe, verifíquelo o contacte al administrador...');
      $this->emit('cveProgramaExistente',$cveo,$pcheck);
    }elseif(isset($pcheck2[0]->cve_programa) & ($cveo == $cven )) {

      session()->flash('info', 'El programa con nombre:'.strtoupper($this->programa).' ya existe, verifíquelo o contacte al administrador...');
      $this->emit('ProgramaExistente',$cveo,$pcheck2);
    }else {

      DB::beginTransaction();
      try {
        $programa=Programa::find($cveo);
        $programa->cve_dependencia=strtoupper($this->cve_dependencia);
        $programa->cve_programa=$cven;
        $programa->programa=strtoupper($this->programa);
        $programa->push();

        DB::commit();
        session()->flash('info', 'Se actualizó correctamente el programa: '.strtoupper($this->programa));
        $this->emit('programaActualizado',(strtoupper($this->programa))); // Close model to using to jquery

      } catch (\Exception $e) {
        DB::rollBack();
        session()->flash('info', 'Error en la edición, contacte al administrador.');
        $this->emit('errorEditandoPrograma',$e->getMessage(),strtoupper($this->programa));
      }
      $this->limpiarInputs();
      $this->emit('refreshComponent');

    }
  }
  public function eliminarPrograma($cve_programa)
  {
    //dd($cve_programa);

    DB::beginTransaction();
    try {
      $programa=Programa::where('cve_programa',$cve_programa)->get();

      Programa::where('cve_programa',$cve_programa)->delete();
      session()->flash('info', 'Se elimnó correctamente el programa: '.$programa[0]->programa);
      $this->emit('programaEliminado',($programa[0]->programa)); // Close model to using to jquery
      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      session()->flash('info', 'Error eliminando programa, contacte al administrador.');
      $this->emit('errorEliminandoPrograma',$e->getMessage(),$programa[0]->programa);
    }
    $this->limpiarInputs();
    $this->emit('refreshComponent');
  }
    // $programa=Programa::findOrFail($this->cve_programa_old);
    // dd($this->cve_programa_old);

}
