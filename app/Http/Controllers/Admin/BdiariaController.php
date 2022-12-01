<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bdiaria;
use App\Models\Datacenter;
use DB;

class BdiariaController extends Controller
{
  public function __construct(Request $request)
    {
        $this->middleware(['permission:admin|adming|dba|esquema']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function home()
     {
        $datacenters = Datacenter::pluck('DATACENTER','id');
        return View('admin.bdiaria',compact('datacenters'));
     }
    public function index(Request $request)
    {
      $listadoBackups = Bdiaria::select('bdiarias.id','bdiarias.FECHA','esquemas.ESQUEMA','bases.BASE','estadobackups.ESTADO_BACKUP','bdiarias.ARCHIVOS','bdiarias.OBSERVACIONES')
      ->join('esquemas','esquemas.id','=','bdiarias.CVE_ESQUEMA')
      ->join('bases','bases.id','=','esquemas.CVE_BASE')
      ->join('estadobackups','estadobackups.id','=','bdiarias.CVE_ESTADOBACKUP')
      ->get();


      foreach (json_decode($listadoBackups[0]->ARCHIVOS) as $area)
        {
        dd($area); // this is your area from json response
        }


        if ($request->ajax()) {
          return datatables()->of($listadoBackups)
          ->addColumn('ACTION', function($row){
              $actionBtn = '<a href="javascript:void(0)" id="editarbackup" class="text-success"><i class="fas fa-user-edit"></i></a>
                            <a href="javascript:void(0)" id="eliminarbackup" class="text-danger"><i class="fas fa-user-times"></i></a> '
              ;
            return $actionBtn;
            })
          ->rawColumns(['ACTION'])
          // ->toJson()
          ->make(true)
        ;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $Backup = Bdiaria::select('bdiarias.id','bdiarias.FECHA','esquemas.ESQUEMA','bases.BASE','estadobackups.ESTADO_BACKUP','bdiarias.ARCHIVOS','bdiarias.OBSERVACIONES')
      ->join('esquemas','esquemas.id','=','bdiarias.CVE_ESQUEMA')
      ->join('bases','bases.id','=','esquemas.CVE_BASE')
      ->join('estadobackups','estadobackups.id','=','bdiarias.CVE_ESTADOBACKUP')
      ->where('bdiarias.id','=',$id )
      ->get();

      $Estadobackups = DB::table('estadobackups')->select('id','ESTADO_BACKUP')->get();

      return [$Backup,$Estadobackups];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
