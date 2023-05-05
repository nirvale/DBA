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
use Carbon\Carbon;

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

        if (is_null($request->cve_datacenter) && is_null($request->cve_base) && is_null($request->cve_esquema) && is_null($request->cve_fecha)) {
                $listadoBackups = Bdiaria::select('bdiarias.id','bdiarias.fecha','esquemas.esquema','bases.base','estadobackups.estado_backup','bdiarias.archivos','bdiarias.observaciones','users.name')
                    ->join('esquemas','esquemas.id','=','bdiarias.cve_esquema')
                    ->join('bases','bases.id','=','esquemas.cve_base')
                    ->join('estadobackups','estadobackups.id','=','bdiarias.cve_estadobackup')
                    ->join('users','users.id','=','bdiarias.cve_user')
                    ->withCasts(['fecha' => 'date:Y-m-d'])
                    ->get();
        }elseif (isset($request->cve_datacenter) && is_null($request->cve_base) && is_null($request->cve_esquema) && is_null($request->cve_fecha)) {
                $dbs = DB::table('bases')->where('cve_datacenter',$request->cve_datacenter)->pluck('id');
                $listadoBackups = Bdiaria::select('bdiarias.id','bdiarias.fecha','esquemas.esquema','bases.base','estadobackups.estado_backup','bdiarias.archivos','bdiarias.observaciones','users.name')
                    ->join('esquemas','esquemas.id','=','bdiarias.cve_esquema')
                    ->join('bases','bases.id','=','esquemas.cve_base')
                    ->join('estadobackups','estadobackups.id','=','bdiarias.cve_estadobackup')
                    ->join('users','users.id','=','bdiarias.cve_user')
                    ->wherein('esquemas.cve_base',$dbs)
                    ->withCasts(['fecha' => 'date:Y-m-d'])
                    ->get();
        }elseif (isset($request->cve_datacenter) && isset($request->cve_base) && is_null($request->cve_esquema) && is_null($request->cve_fecha)) {
                $listadoBackups = Bdiaria::select('bdiarias.id','bdiarias.fecha','esquemas.esquema','bases.base','estadobackups.estado_backup','bdiarias.archivos','bdiarias.observaciones','users.name')
                    ->join('esquemas','esquemas.id','=','bdiarias.cve_esquema')
                    ->join('bases','bases.id','=','esquemas.cve_base')
                    ->join('estadobackups','estadobackups.id','=','bdiarias.cve_estadobackup')
                    ->join('users','users.id','=','bdiarias.cve_user')
                    ->where('esquemas.cve_base',$request->cve_base)
                    ->withCasts(['fecha' => 'date:Y-m-d'])
                    ->get();
        }elseif(isset($request->cve_datacenter) && isset($request->cve_base) && isset($request->cve_esquema) && is_null($request->cve_fecha)){
                $listadoBackups = Bdiaria::select('bdiarias.id','bdiarias.fecha','esquemas.esquema','bases.base','estadobackups.estado_backup','bdiarias.archivos','bdiarias.observaciones','users.name')
                    ->join('esquemas','esquemas.id','=','bdiarias.cve_esquema')
                    ->join('bases','bases.id','=','esquemas.cve_base')
                    ->join('estadobackups','estadobackups.id','=','bdiarias.cve_estadobackup')
                    ->join('users','users.id','=','bdiarias.cve_user')
                    ->where('esquemas.id',$request->cve_esquema)
                    ->withCasts(['fecha' => 'date:Y-m-d'])
                    ->get();
        }elseif (isset($request->cve_datacenter) && isset($request->cve_base) && isset($request->cve_esquema) && isset($request->cve_fecha)) {
                 $listadoBackups = Bdiaria::select('bdiarias.id','bdiarias.fecha','esquemas.esquema','bases.base','estadobackups.estado_backup','bdiarias.archivos','bdiarias.observaciones','users.name')
                    ->join('esquemas','esquemas.id','=','bdiarias.cve_esquema')
                    ->join('bases','bases.id','=','esquemas.cve_base')
                    ->join('estadobackups','estadobackups.id','=','bdiarias.cve_estadobackup')
                    ->join('users','users.id','=','bdiarias.cve_user')
                    ->where('esquemas.id',$request->cve_esquema)
                    ->where('bdiarias.fecha',$request->cve_fecha)
                    ->withCasts(['fecha' => 'date:Y-m-d'])
                    ->get();
        }elseif (is_null($request->cve_datacenter) && is_null($request->cve_base) && is_null($request->cve_esquema) && isset($request->cve_fecha)) {
                $listadoBackups = Bdiaria::select('bdiarias.id','bdiarias.fecha','esquemas.esquema','bases.base','estadobackups.estado_backup','bdiarias.archivos','bdiarias.observaciones','users.name')
                    ->join('esquemas','esquemas.id','=','bdiarias.cve_esquema')
                    ->join('bases','bases.id','=','esquemas.cve_base')
                    ->join('estadobackups','estadobackups.id','=','bdiarias.cve_estadobackup')
                    ->join('users','users.id','=','bdiarias.cve_user')
                    ->where('bdiarias.fecha',$request->cve_fecha)
                    ->withCasts(['fecha' => 'date:Y-m-d'])
                    ->get();
        }elseif (isset($request->cve_datacenter) && isset($request->cve_base) && is_null($request->cve_esquema) && isset($request->cve_fecha)) {
                $listadoBackups = Bdiaria::select('bdiarias.id','bdiarias.fecha','esquemas.esquema','bases.base','estadobackups.estado_backup','bdiarias.archivos','bdiarias.observaciones','users.name')
                    ->join('esquemas','esquemas.id','=','bdiarias.cve_esquema')
                    ->join('bases','bases.id','=','esquemas.cve_base')
                    ->join('estadobackups','estadobackups.id','=','bdiarias.cve_estadobackup')
                    ->join('users','users.id','=','bdiarias.cve_user')
                    ->where('esquemas.cve_base',$request->cve_base)
                    ->where('bdiarias.fecha',$request->cve_fecha)
                    ->withCasts(['fecha' => 'date:Y-m-d'])
                    ->get();
        }elseif (isset($request->cve_datacenter) && is_null($request->cve_base) && is_null($request->cve_esquema) && isset($request->cve_fecha)) {
                $dbs = DB::table('bases')->where('cve_datacenter',$request->cve_datacenter)->pluck('id');
                $listadoBackups = Bdiaria::select('bdiarias.id','bdiarias.fecha','esquemas.esquema','bases.base','estadobackups.estado_backup','bdiarias.archivos','bdiarias.observaciones','users.name')
                    ->join('esquemas','esquemas.id','=','bdiarias.cve_esquema')
                    ->join('bases','bases.id','=','esquemas.cve_base')
                    ->join('estadobackups','estadobackups.id','=','bdiarias.cve_estadobackup')
                    ->join('users','users.id','=','bdiarias.cve_user')
                    ->wherein('esquemas.cve_base',$dbs)
                    ->where('bdiarias.fecha',$request->cve_fecha)
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
        $request->merge(['daysem'=> Carbon::parse($request->cve_fecha)->dayOfWeek]);
        $validated=\Validator::make($request->all(), [
           'cve_datacenter' => 'bail|required|max:1',
           'cve_base' => ['bail','required','max:2'],
           'cve_fecha' => 'bail|required|before:today',
           'daysem' => ['bail','required','max:1', Rule::notIn(['0','6'])],
        ]);
        if ($validated->fails()) {
            return response()->json(['errors'=>$validated->errors()->all()]);
        }elseif ($validated) {
            $esq = DB::table('esquemas')->where('cve_base',$request->cve_base)->pluck('id');
            $bitcheck = Bdiaria::select('bdiarias.id','bdiarias.fecha','esquemas.esquema','bases.base','estadobackups.estado_backup','bdiarias.archivos','bdiarias.observaciones','users.name')
                        ->join('esquemas','esquemas.id','=','bdiarias.cve_esquema')
                        ->join('bases','bases.id','=','esquemas.cve_base')
                        ->join('estadobackups','estadobackups.id','=','bdiarias.cve_estadobackup')
                        ->join('users','users.id','=','bdiarias.cve_user')
                        ->wherein('bdiarias.cve_esquema',$esq)
                        ->where('bdiarias.fecha',$request->cve_fecha)
                        ->withCasts(['fecha' => 'date:Y-m-d'])
                        ->first();
            if (is_null($bitcheck)) {
                $request->merge(['bitcheck' => 1]);
            }

            $dbtobit = DB::table('bases')->select('cve_tipo')->where('id',$request->cve_base)->get();
            $request->merge(['dbtobit' => $dbtobit[0]->cve_tipo]);
            $validated=\Validator::make($request->all(), [
               'cve_datacenter' => 'bail|required|max:1',
               'cve_base' => ['bail','required','max:2'],
               'dbtobit' => ['bail','required','max:2', Rule::notIn(['1','2','4','5'])],
               'cve_fecha' => 'bail|required|before:today',
               'bitcheck' => 'bail|required|max:1',
               'daysem' => ['bail','required','max:1', Rule::notIn(['0','6'])],
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


    }

    public function createe(Request $request)
    {

         $validated=\Validator::make($request->all(), [
           'cve_datacenter' => 'bail|required|max:1',
           'cve_base' => ['bail','required','max:2'],
           'cve_fechae' => ['bail','required'],
        ]);
        if ($validated->fails()) {
            return response()->json(['errors'=>$validated->errors()->all()]);
        }elseif ($validated) {
            $esq = DB::table('esquemas')->where('cve_base',$request->cve_base)->pluck('id');
            $bitcheck = Bdiaria::select('bdiarias.id','bdiarias.fecha','esquemas.esquema','bases.base','estadobackups.estado_backup','bdiarias.archivos','users.name')
                        ->join('esquemas','esquemas.id','=','bdiarias.cve_esquema')
                        ->join('bases','bases.id','=','esquemas.cve_base')
                        ->join('estadobackups','estadobackups.id','=','bdiarias.cve_estadobackup')
                        ->join('users','users.id','=','bdiarias.cve_user')
                        ->wherein('bdiarias.cve_esquema',$esq)
                        ->where('bdiarias.fecha',$request->cve_fechae)
                        ->withCasts(['fecha' => 'date:Y-m-d'])
                        ->first();
            if (is_null($bitcheck)) {
            $request->merge(['bitchecke' => null]);
            }else {
                $request->merge(['bitchecke' => 1]);
            }

            $dbtobit = DB::table('bases')->select('cve_tipo')->where('id',$request->cve_base)->get();
            $request->merge(['dbtobit' => $dbtobit[0]->cve_tipo]);
            $validated=\Validator::make($request->all(), [
               'cve_datacenter' => 'bail|required|max:1',
               'cve_base' => ['bail','required','max:2'],
               'dbtobit' => ['bail','required','max:2', Rule::notIn(['1','2','4','5'])],
               'cve_fechae' => 'bail|required|before:today',
               'bitchecke' => 'bail|required|max:1',
            ]);

            if ($validated->fails())
            {
             return response()->json(['errors'=>$validated->errors()->all()]);
            }elseif ($validated) {

                $esquemas =Bdiaria::select('bdiarias.id as cve_bdiaria','bdiarias.fecha','esquemas.esquema','bases.base','estadobackups.estado_backup','bdiarias.archivos','bdiarias.observaciones','users.name')
                    ->join('esquemas','esquemas.id','=','bdiarias.cve_esquema')
                    ->join('bases','bases.id','=','esquemas.cve_base')
                    ->join('estadobackups','estadobackups.id','=','bdiarias.cve_estadobackup')
                    ->join('users','users.id','=','bdiarias.cve_user')
                    ->where('esquemas.cve_base',$request->cve_base)
                    ->where('bdiarias.fecha',$request->cve_fechae)
                    ->withCasts(['fecha' => 'date:Y-m-d'])
                    ->get();


                $estadobackups=Estadobackup::select('id','estado_backup')->get();


                return [$esquemas,$estadobackups];
            }
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
        $request->merge(['daysem'=> Carbon::parse($request->bitdate)->dayOfWeek]);
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
            'daysem' => ['bail','required','max:1', Rule::notIn(['0','6'])]

        ]);

        if ($validated->fails())
        {
         return response()->json(['errors'=>$validated->errors()->all()]);
        }elseif ($validated) {
            $h=date("Ymd_his");
            $logs = $request->file('bdiaria_archivos');
            foreach ($logs as $log) {
                $nombre = str_replace(' ', '_', $request->base[0] . '_DIARIO_' . str_replace('-', '', $request->bitdate ). '_' . $h .'.tar.' . $log->getClientOriginalExtension());
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
                    $bdiaria->observaciones = '/'.$h."->CREAR:\n".$request->observaciones."\n". '/' . $h."->FINCREAR\n \n";
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

    public function updateb(Request $request)
    {
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
            $h=date("Ymd_his");
            $logs = $request->file('bdiaria_archivos');
            foreach ($logs as $log) {
                $nombre = str_replace(' ', '_', $request->base[0] . '_DIARIO_' . str_replace('-', '', $request->bitdate ). '_' . $h .'.tar.' . $log->getClientOriginalExtension());
                // $nombre = $request->base[0] . '_diario_' . $request->fecha . '_' . $h .'.tar.' . $log->getClientOriginalExtension();
                $path = $log->storeAs('bdiarias', $nombre);
                $urls0[] = $nombre;

               }

            DB::beginTransaction();
            try {

                for ($i=0; $i < $request->ndata ; $i++) {
                    $bdiaria = Bdiaria::FindOrFail($request->cve_bdiaria[$i]);
                    $urls = array_merge(json_decode($bdiaria->archivos),$urls0);
                    //array_unshift($urls, json_decode($bdiaria->archivos));
                    //$urls[0]=json_decode($bdiaria->archivos);
                   // $bdiaria->fecha = $request->bitdate;
                   // $bdiaria->cve_esquema = $request->cve_esquema[$i];
                    $bdiaria->cve_estadobackup = $request->selEstadoBackup[$i];
                    $bdiaria->observaciones = $bdiaria->observaciones . '/'. $h."->EDITAR:\n".$request->observaciones."\n". '/'. $h."->FINEDITAR\n \n";
                    $bdiaria->archivos = json_encode($urls);
                    $bdiaria->cve_user = Auth::user()->id;
                    //return $bdiaria;
                    $bdiaria->push();
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
           'observaciones' => 'bail|required|max:300',
        ]);

        if ($validated->fails())
        {
         return response()->json(['errors'=>$validated->errors()->all()]);
        }elseif ($validated) {
        $bdiaria = Bdiaria::FindOrFail($request->id);
        $urls=json_decode($bdiaria->archivos);
        $h=date("Ymd_his");
        if ($request->file('bdiaria_archivos')) {
            $logs = $request->file('bdiaria_archivos');

            foreach ($logs as $log) {
                $nombre = str_replace(' ', '_', $request->base . '-' . $request->esquema. '-' . str_replace('-', '', $request->fecha ) . '-' . $h .'.tar.' . $log->getClientOriginalExtension());
                 //$nombre = $request->base . '_' . $request->esquema . '_' . $request->fecha . '_' . $h .'.tar.' . $log->getClientOriginalExtension();
                 $path = $log->storeAs('bdiarias', $nombre);
                 $urls[] = $nombre;

               }

        }


            DB::beginTransaction();
            try {
                $bdiaria->cve_estadobackup = $request->cve_estadobackup;
                $bdiaria->observaciones = $bdiaria->observaciones. '/'. $h."->EDITAR:\n".$request->observaciones."\n". '/' .$h."->FINEDITAR\n \n";
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
