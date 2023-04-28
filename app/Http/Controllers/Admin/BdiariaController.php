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
        $datacenters = Datacenter::pluck('datacenter','id');
        return View('admin.bdiaria',compact('datacenters'));
     }
    public function index(Request $request)
    {

        if (is_null($request->cve_datacenter) && is_null($request->cve_base) && is_null($request->cve_esquema)) {
            $listadoBackups = Bdiaria::select('bdiarias.id','bdiarias.fecha','esquemas.esquema','bases.base','estadobackups.estado_backup','bdiarias.archivos','bdiarias.observaciones','users.name')
                ->join('esquemas','esquemas.id','=','bdiarias.cve_esquema')
                ->join('bases','bases.id','=','esquemas.cve_base')
                ->join('estadobackups','estadobackups.id','=','bdiarias.cve_estadobackup')
                ->join('users','users.id','=','bdiarias.cve_user')
                ->withCasts(['fecha' => 'date:Y-m-d'])
                ->get();
        }elseif (isset($request->cve_datacenter) && is_null($request->cve_base) && is_null($request->cve_esquema)) {
            $dbs = DB::table('bases')->where('cve_datacenter',$request->cve_datacenter)->pluck('id');
            $listadoBackups = Bdiaria::select('bdiarias.id','bdiarias.fecha','esquemas.esquema','bases.base','estadobackups.estado_backup','bdiarias.archivos','bdiarias.observaciones','users.name')
                ->join('esquemas','esquemas.id','=','bdiarias.cve_esquema')
                ->join('bases','bases.id','=','esquemas.cve_base')
                ->join('estadobackups','estadobackups.id','=','bdiarias.cve_estadobackup')
                ->join('users','users.id','=','bdiarias.cve_user')
                ->wherein('esquemas.cve_base',$dbs)
                ->withCasts(['fecha' => 'date:Y-m-d'])
                ->get();
        }elseif (isset($request->cve_datacenter) && isset($request->cve_base) && is_null($request->cve_esquema)) {
            $listadoBackups = Bdiaria::select('bdiarias.id','bdiarias.fecha','esquemas.esquema','bases.base','estadobackups.estado_backup','bdiarias.archivos','bdiarias.observaciones','users.name')
                ->join('esquemas','esquemas.id','=','bdiarias.cve_esquema')
                ->join('bases','bases.id','=','esquemas.cve_base')
                ->join('estadobackups','estadobackups.id','=','bdiarias.cve_estadobackup')
                ->join('users','users.id','=','bdiarias.cve_user')
                ->where('esquemas.cve_base',$request->cve_base)
                ->withCasts(['fecha' => 'date:Y-m-d'])
                ->get();
        }elseif(isset($request->cve_datacenter) && isset($request->cve_base) && isset($request->cve_esquema)){
                $listadoBackups = Bdiaria::select('bdiarias.id','bdiarias.fecha','esquemas.esquema','bases.base','estadobackups.estado_backup','bdiarias.archivos','bdiarias.observaciones','users.name')
                ->join('esquemas','esquemas.id','=','bdiarias.cve_esquema')
                ->join('bases','bases.id','=','esquemas.cve_base')
                ->join('estadobackups','estadobackups.id','=','bdiarias.cve_estadobackup')
                ->join('users','users.id','=','bdiarias.cve_user')
                ->where('esquemas.id',$request->cve_esquema)
                ->withCasts(['fecha' => 'date:Y-m-d'])
                ->get();
        }


      // foreach (json_decode($listadoBackups[0]->archivos) as $area)
      //   {
      //   dd($area); // this is your area from json response
      //   }


        if ($request->ajax()) {
          return datatables()->of($listadoBackups)
          ->addColumn('ACTION', function($row){
              $actionBtn = '<a href="javascript:void(0)" id="editarbackup" class="text-success"><i class="fas fa-user-edit"></i></a>'
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
                'esquemas.id as cve_esquema',
                'esquemas.esquema',
                'bases.base'
            )
            ->join('bases','bases.id','esquemas.cve_base')
            ->where('esquemas.cve_base',$request->cve_base)
            ->where('esquemas.cve_backup','1') //backup diarío
            ->get();

            $estadobackups=Estadobackup::select('id','estado_backup')->get();


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
            'observaciones' => 'bail|required',
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
                    $bdiaria->fecha = $request->bitdate;
                    $bdiaria->cve_esquema = $request->cve_esquema[$i];
                    $bdiaria->cve_estadobackup = $request->selEstadoBackup[$i];
                    $bdiaria->observaciones = $request->observaciones;
                    $bdiaria->archivos = json_encode($urls);
                    $bdiaria->cve_user = Auth::user()->id;
                    //return $bdiaria;
                    $bdiaria->save();
                }
            DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return $e;
             }
            return [$bdiaria->fecha];
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
      $Backup = Bdiaria::select('bdiarias.id','bdiarias.fecha','esquemas.esquema','bases.base','estadobackups.estado_backup','bdiarias.archivos','bdiarias.observaciones')
      ->join('esquemas','esquemas.id','=','bdiarias.cve_esquema')
      ->join('bases','bases.id','=','esquemas.cve_base')
      ->join('estadobackups','estadobackups.id','=','bdiarias.cve_estadobackup')
      ->where('bdiarias.id','=',$id )
      ->withCasts(['fecha' => 'date:Y-m-d'])
      ->get();

      $Estadobackups = DB::table('estadobackups')->select('id','estado_backup')->get();

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

        $validated=\Validator::make($request->all(), [
           'id' => 'bail|required',
           'bdiaria_archivos.*' => 'mimetypes:application/gzip|max: 512',
           'cve_estadobackup' => 'bail|required|max:1',
           //'observaciones' => 'bail|required|max:300',
        ]);

        if ($validated->fails())
        {
         return response()->json(['errors'=>$validated->errors()->all()]);
        }elseif ($validated) {
        $bdiaria = Bdiaria::FindOrFail($request->id);
        $urls=json_decode($bdiaria->archivos);
        $h=date("Y-m-d-h-i");
        if ($request->file('bdiaria_archivos')) {
            $logs = $request->file('bdiaria_archivos');

            foreach ($logs as $log) {
                $nombre = str_replace(' ', '_', $request->base . '_' . $request->esquema . '_' . $request->fecha . '_' . $h .'.tar.' . $log->getClientOriginalExtension());
                 //$nombre = $request->base . '_' . $request->esquema . '_' . $request->fecha . '_' . $h .'.tar.' . $log->getClientOriginalExtension();
                 $path = $log->storeAs('bdiarias', $nombre);
                 $urls[] = $nombre;

               }

        }


            DB::beginTransaction();
            try {
                $bdiaria->cve_estadobackup = $request->cve_estadobackup;
                $bdiaria->observaciones = $request->observaciones;
                $bdiaria->archivos = json_encode($urls);
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
