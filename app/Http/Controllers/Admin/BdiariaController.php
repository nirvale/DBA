<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bdiaria;
use App\Models\Datacenter;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\Esquema;
use App\Models\Estadobackup;
use Auth;

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

        if (is_null($request->cve_datacenter) && is_null($request->cve_base)) {
            $listadoBackups = Bdiaria::select('bdiarias.id','bdiarias.FECHA','esquemas.ESQUEMA','bases.BASE','estadobackups.ESTADO_BACKUP','bdiarias.ARCHIVOS','bdiarias.OBSERVACIONES','users.name')
                ->join('esquemas','esquemas.id','=','bdiarias.CVE_ESQUEMA')
                ->join('bases','bases.id','=','esquemas.CVE_BASE')
                ->join('estadobackups','estadobackups.id','=','bdiarias.CVE_ESTADOBACKUP')
                ->join('users','users.id','=','bdiarias.CVE_USER')
                ->get();
        }elseif (isset($request->cve_datacenter) && is_null($request->cve_base)) {
            $dbs = DB::table('bases')->where('CVE_DATACENTER',$request->cve_datacenter)->pluck('id');
            $listadoBackups = Bdiaria::select('bdiarias.id','bdiarias.FECHA','esquemas.ESQUEMA','bases.BASE','estadobackups.ESTADO_BACKUP','bdiarias.ARCHIVOS','bdiarias.OBSERVACIONES','users.name')
                ->join('esquemas','esquemas.id','=','bdiarias.CVE_ESQUEMA')
                ->join('bases','bases.id','=','esquemas.CVE_BASE')
                ->join('estadobackups','estadobackups.id','=','bdiarias.CVE_ESTADOBACKUP')
                ->join('users','users.id','=','bdiarias.CVE_USER')
                ->wherein('esquemas.CVE_BASE',$dbs)
                ->get();
        }elseif (isset($request->cve_datacenter) && isset($request->cve_base)) {
            $listadoBackups = Bdiaria::select('bdiarias.id','bdiarias.FECHA','esquemas.ESQUEMA','bases.BASE','estadobackups.ESTADO_BACKUP','bdiarias.ARCHIVOS','bdiarias.OBSERVACIONES','users.name')
                ->join('esquemas','esquemas.id','=','bdiarias.CVE_ESQUEMA')
                ->join('bases','bases.id','=','esquemas.CVE_BASE')
                ->join('estadobackups','estadobackups.id','=','bdiarias.CVE_ESTADOBACKUP')
                ->join('users','users.id','=','bdiarias.CVE_USER')
                ->where('esquemas.CVE_BASE',$request->cve_base)
                ->get();
        }



      // foreach (json_decode($listadoBackups[0]->ARCHIVOS) as $area)
      //   {
      //   dd($area); // this is your area from json response
      //   }


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
    public function create(Request $request)
    {
        $validated=\Validator::make($request->all(), [
           'cve_datacenter' => 'bail|required|max:1',
           'cve_base' => ['bail','required','max:1', Rule::notIn(['2'])],
        ]);

        if ($validated->fails())
        {
         return response()->json(['errors'=>$validated->errors()->all()]);
        }elseif ($validated) {
            $esquemas = Esquema::select(
                'esquemas.id as CVE_ESQUEMA',
                'esquemas.ESQUEMA',
                'bases.BASE'
            )
            ->join('bases','bases.id','esquemas.CVE_BASE')
            ->where('esquemas.CVE_BASE',$request->cve_base)
            ->where('esquemas.CVE_BACKUP','1') //backup diarío
            ->get();

            $estadobackups=Estadobackup::select()->get();


            return [$esquemas,$estadobackups];
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//return $request;

       $validated=\Validator::make($request->all(), [
            'bitdate' => 'bail|required|date',
            'selUsuario' => 'bail|required|integer',
            'bdiaria_archivos' => 'bail|required',
            'bdiaria_archivos.*' => 'bail|required|mimetypes:application/gzip|max: 512',
            'base.*' => 'bail|required',
            'cve_esquema.*' => 'bail|required|max:5',
            'esquema.*' => 'bail|required',
            'selEstadoBackup.*' => ['bail','required', 'max: 1', Rule::In(['1','2','3'])],

        ]);

        if ($validated->fails())
        {
         return response()->json(['errors'=>$validated->errors()->all()]);
        }elseif ($validated) {
            $h=date("Y-m-d-h-i");
            $logs = $request->file('bdiaria_archivos');
            foreach ($logs as $log) {
                $nombre = str_replace(' ', '_', $request->base[0] . '_diario_' . $request->bitdate. '_' . $h .'.tar.' . $log->getClientOriginalExtension());
                // $nombre = $request->base[0] . '_diario_' . $request->fecha . '_' . $h .'.tar.' . $log->getClientOriginalExtension();
                $path = $log->storeAs('bdiarias', $nombre);
                $urls[] = $nombre;

               }

            DB::beginTransaction();
            try {

                for ($i=0; $i < $request->ndata ; $i++) {
                    $bdiaria = new Bdiaria;
                    $bdiaria->FECHA = $request->bitdate;
                    $bdiaria->CVE_ESQUEMA = $request->cve_esquema[$i];
                    $bdiaria->CVE_ESTADOBACKUP = $request->selEstadoBackup[$i];
                    $bdiaria->OBSERVACIONES = $request->OBSERVACIONES;
                    $bdiaria->ARCHIVOS = json_encode($urls);
                    $bdiaria->CVE_USER = Auth::user()->id;
                    //return $bdiaria;
                    $bdiaria->save();
                }
            DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return $e;
             }
            return [$bdiaria->FECHA];
        }
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
//dd($request);

        $validated=\Validator::make($request->all(), [
           'id' => 'bail|required',
           'bdiaria_archivos.*' => 'mimetypes:application/gzip|max: 512',
           'CVE_ESTADOBACKUP' => 'bail|required|max:1',
           //'OBSERVACIONES' => 'bail|required|max:300',
        ]);

        if ($validated->fails())
        {
         return response()->json(['errors'=>$validated->errors()->all()]);
        }elseif ($validated) {

        $bdiaria = Bdiaria::FindOrFail($request->id);
        $urls=json_decode($bdiaria->ARCHIVOS);
        $h=date("Y-m-d-h-i");
        if ($request->file('bdiaria_archivos')) {
            $logs = $request->file('bdiaria_archivos');

            foreach ($logs as $log) {
                $nombre = str_replace(' ', '_', $request->BASE . '_' . $request->esquema . '_' . $request->fecha . '_' . $h .'.tar.' . $log->getClientOriginalExtension());
                 //$nombre = $request->BASE . '_' . $request->esquema . '_' . $request->fecha . '_' . $h .'.tar.' . $log->getClientOriginalExtension();
                 $path = $log->storeAs('bdiarias', $nombre);
                 $urls[] = $nombre;

               }

        }


            DB::beginTransaction();
            try {
                $bdiaria->CVE_ESTADOBACKUP = $request->CVE_ESTADOBACKUP;
                $bdiaria->OBSERVACIONES = $request->OBSERVACIONES;
                $bdiaria->ARCHIVOS = json_encode($urls);
                $bdiaria->push();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return $e;
             }

       }


        return $bdiaria;
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
