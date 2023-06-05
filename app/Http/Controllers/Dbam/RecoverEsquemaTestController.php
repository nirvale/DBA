<?php

namespace App\Http\Controllers\Dbam;

use App\Http\Controllers\Controller;
use App\Models\RecoverEsquemaTest;
use Illuminate\Http\Request;
use App\Models\Datacenter;
use App\Models\Backup;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\Esquema;
use App\Models\EstatusRecoverTest;
// use App\Models\bdiaria;
// use App\Models\bsemanal;
use Auth;
use Carbon\Carbon;

class RecoverEsquemaTestController extends Controller
{
  public function __construct(Request $request)
    {
        $this->middleware(['role_or_permission:Administrador de Base de Datos|DBA Junior|admin|adming']);
    }
    public function home()
    {
      $datacenters = Datacenter::pluck('datacenter','id');
      $backups = Backup::whereNotIn('id',['3','4'])->pluck('backup','id');

      return view('dbam.recoveretest',compact('datacenters','backups'),['info'=>null]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if (is_null($request->cve_datacenter) && is_null($request->cve_base) && is_null($request->cve_backup) && is_null($request->cve_fecha)) {
              $listadoTests = RecoverEsquemaTest::select('recover_esquema_tests.id','recover_esquema_tests.fecha','esquemas.esquema','bases.base','estatus_recover_tests.estatusrecovert','recover_esquema_tests.archivos','recover_esquema_tests.observaciones','users.name')
                  ->join('esquemas','esquemas.id','=','recover_esquema_tests.cve_esquema')
                  ->join('bases','bases.id','=','esquemas.cve_base')
                  ->join('estatus_recover_tests','estatus_recover_tests.id','=','recover_esquema_tests.cve_estatusrecovertest')
                  ->join('users','users.id','=','recover_esquema_tests.cve_user')
                  ->withCasts(['fecha' => 'date:Y-m-d'])
                  ->get();
      }elseif (isset($request->cve_datacenter) && is_null($request->cve_base) && is_null($request->cve_backup) && is_null($request->cve_fecha)) {
              $dbs = DB::table('bases')->where('cve_datacenter',$request->cve_datacenter)->pluck('id');
              $listadoTests = RecoverEsquemaTest::select('recover_esquema_tests.id','recover_esquema_tests.fecha','esquemas.esquema','bases.base','estatus_recover_tests.estatusrecovert','recover_esquema_tests.archivos','recover_esquema_tests.observaciones','users.name')
                  ->join('esquemas','esquemas.id','=','recover_esquema_tests.cve_esquema')
                  ->join('bases','bases.id','=','esquemas.cve_base')
                  ->join('estatus_recover_tests','estatus_recover_tests.id','=','recover_esquema_tests.cve_estatusrecovertest')
                  ->join('users','users.id','=','recover_esquema_tests.cve_user')
                  ->wherein('esquemas.cve_base',$dbs)
                  ->withCasts(['fecha' => 'date:Y-m-d'])
                  ->get();
      }elseif (isset($request->cve_datacenter) && isset($request->cve_base) && is_null($request->cve_backup) && is_null($request->cve_fecha)) {
              $listadoTests = RecoverEsquemaTest::select('recover_esquema_tests.id','recover_esquema_tests.fecha','esquemas.esquema','bases.base','estatus_recover_tests.estatusrecovert','recover_esquema_tests.archivos','recover_esquema_tests.observaciones','users.name')
                  ->join('esquemas','esquemas.id','=','recover_esquema_tests.cve_esquema')
                  ->join('bases','bases.id','=','esquemas.cve_base')
                  ->join('estatus_recover_tests','estatus_recover_tests.id','=','recover_esquema_tests.cve_estatusrecovertest')
                  ->join('users','users.id','=','recover_esquema_tests.cve_user')
                  ->where('esquemas.cve_base',$request->cve_base)
                  ->withCasts(['fecha' => 'date:Y-m-d'])
                  ->get();
      }elseif(isset($request->cve_datacenter) && isset($request->cve_base) && isset($request->cve_backup) && is_null($request->cve_fecha)){
              $listadoTests = RecoverEsquemaTest::select('recover_esquema_tests.id','recover_esquema_tests.fecha','esquemas.esquema','bases.base','estatus_recover_tests.estatusrecovert','recover_esquema_tests.archivos','recover_esquema_tests.observaciones','users.name')
                  ->join('esquemas','esquemas.id','=','recover_esquema_tests.cve_esquema')
                  ->join('bases','bases.id','=','esquemas.cve_base')
                  ->join('estatus_recover_tests','estatus_recover_tests.id','=','recover_esquema_tests.cve_estatusrecovertest')
                  ->join('users','users.id','=','recover_esquema_tests.cve_user')
                  ->where('esquemas.cve_base',$request->cve_base)
                  ->where('esquemas.cve_backup',$request->cve_backup)
                  ->withCasts(['fecha' => 'date:Y-m-d'])
                  ->get();
      }elseif (isset($request->cve_datacenter) && isset($request->cve_base) && isset($request->cve_backup) && isset($request->cve_fecha)) {
               $listadoTests = RecoverEsquemaTest::select('recover_esquema_tests.id','recover_esquema_tests.fecha','esquemas.esquema','bases.base','estatus_recover_tests.estatusrecovert','recover_esquema_tests.archivos','recover_esquema_tests.observaciones','users.name')
                  ->join('esquemas','esquemas.id','=','recover_esquema_tests.cve_esquema')
                  ->join('bases','bases.id','=','esquemas.cve_base')
                  ->join('estatus_recover_tests','estatus_recover_tests.id','=','recover_esquema_tests.cve_estatusrecovertest')
                  ->join('users','users.id','=','recover_esquema_tests.cve_user')
                  ->where('esquemas.cve_base',$request->cve_base)
                  ->where('esquemas.cve_backup',$request->cve_backup)
                  ->where('recover_esquema_tests.fecha',$request->cve_fecha)
                  ->withCasts(['fecha' => 'date:Y-m-d'])
                  ->get();
      }elseif (is_null($request->cve_datacenter) && is_null($request->cve_base) && is_null($request->cve_backup) && isset($request->cve_fecha)) {
              $listadoTests = RecoverEsquemaTest::select('recover_esquema_tests.id','recover_esquema_tests.fecha','esquemas.esquema','bases.base','estatus_recover_tests.estatusrecovert','recover_esquema_tests.archivos','recover_esquema_tests.observaciones','users.name')
                  ->join('esquemas','esquemas.id','=','recover_esquema_tests.cve_esquema')
                  ->join('bases','bases.id','=','esquemas.cve_base')
                  ->join('estatus_recover_tests','estatus_recover_tests.id','=','recover_esquema_tests.cve_estatusrecovertest')
                  ->join('users','users.id','=','recover_esquema_tests.cve_user')
                  ->where('recover_esquema_tests.fecha',$request->cve_fecha)
                  ->withCasts(['fecha' => 'date:Y-m-d'])
                  ->get();
      }elseif (isset($request->cve_datacenter) && isset($request->cve_base) && is_null($request->cve_backup) && isset($request->cve_fecha)) {
              $listadoTests = RecoverEsquemaTest::select('recover_esquema_tests.id','recover_esquema_tests.fecha','esquemas.esquema','bases.base','estatus_recover_tests.estatusrecovert','recover_esquema_tests.archivos','recover_esquema_tests.observaciones','users.name')
                  ->join('esquemas','esquemas.id','=','recover_esquema_tests.cve_esquema')
                  ->join('bases','bases.id','=','esquemas.cve_base')
                  ->join('estatus_recover_tests','estatus_recover_tests.id','=','recover_esquema_tests.cve_estatusrecovertest')
                  ->join('users','users.id','=','recover_esquema_tests.cve_user')
                  ->where('esquemas.cve_base',$request->cve_base)
                  ->where('recover_esquema_tests.fecha',$request->cve_fecha)
                  ->withCasts(['fecha' => 'date:Y-m-d'])
                  ->get();
      }elseif (isset($request->cve_datacenter) && is_null($request->cve_base) && is_null($request->cve_backup) && isset($request->cve_fecha)) {
              $dbs = DB::table('bases')->where('cve_datacenter',$request->cve_datacenter)->pluck('id');
              $listadoTests = RecoverEsquemaTest::select('recover_esquema_tests.id','recover_esquema_tests.fecha','esquemas.esquema','bases.base','estatus_recover_tests.estatusrecovert','recover_esquema_tests.archivos','recover_esquema_tests.observaciones','users.name')
                  ->join('esquemas','esquemas.id','=','recover_esquema_tests.cve_esquema')
                  ->join('bases','bases.id','=','esquemas.cve_base')
                  ->join('estatus_recover_tests','estatus_recover_tests.id','=','recover_esquema_tests.cve_estatusrecovertest')
                  ->join('users','users.id','=','recover_esquema_tests.cve_user')
                  ->wherein('esquemas.cve_base',$dbs)
                  ->where('recover_esquema_tests.fecha',$request->cve_fecha)
                  ->withCasts(['fecha' => 'date:Y-m-d'])
                  ->get();
      }




      if ($request->ajax()) {
        return datatables()->of($listadoTests)
        ->addColumn('ACTION', function($row){
            $actionBtn = '<a href="javascript:void(0)" id="editarecovertest" class="text-success"><i class="fas fa-edit"></i></a> <a href="javascript:void(0)" id="eliminarecovertest" class="text-danger"><i class="fas fa-trash-alt"></i></a>'
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
      if ($request->daysem>=1 && $request->daysem<=5 ) {
        $validated=\Validator::make($request->all(), [
           'cve_datacenter' => 'bail|required|max:1',
           'cve_base' => ['bail','required','max:2'],
           'cve_fecha' => 'bail|required|before:today',
           'cve_backup' => ['bail','required','max:1', Rule::In(['1'])],
           'daysem' => ['bail','required','max:1', Rule::notIn(['0','6'])],
        ]);
      }elseif ($request->daysem==6) {
        $validated=\Validator::make($request->all(), [
           'cve_datacenter' => 'bail|required|max:1',
           'cve_base' => ['bail','required','max:2'],
           'cve_fecha' => 'bail|required|before:today',
           'cve_backup' => ['bail','required','max:1', Rule::In(['2'])],
           'daysem' => ['bail','required','max:1', Rule::notIn(['0','1','2','3','4','5'])],
        ]);
      }elseif ($request->daysem==0) {
        $validated=\Validator::make($request->all(), [
           'cve_datacenter' => 'bail|required|max:1',
           'cve_base' => ['bail','required','max:2'],
           'cve_fecha' => 'bail|required|before:today',
           //'cve_backup' => ['bail','required','max:1', Rule::In(['1','2'])],
           'daysem' => ['bail','required','max:1', Rule::notIn(['0'])],
        ]);
      }

      if ($validated->fails()) {
          return response()->json(['errors'=>$validated->errors()->all()]);
      }elseif ($validated) {
          if ($request->cve_backup==1) {
            $request->merge(['name_tabla' => 'bdiaria']);
          }elseif ($request->cve_backup==2) {
            $request->merge(['name_tabla' => 'bsemanal']);
          }
          $esq = DB::table('esquemas')->where('cve_base',$request->cve_base)->pluck('id');
          $testcheck = RecoverEsquemaTest::select('recover_esquema_tests.id','recover_esquema_tests.fecha','esquemas.esquema','bases.base','estatus_recover_tests.estatusrecovert','recover_esquema_tests.archivos','recover_esquema_tests.observaciones','users.name')
                      ->join('esquemas','esquemas.id','=','recover_esquema_tests.cve_esquema')
                      ->join('bases','bases.id','=','esquemas.cve_base')
                      ->join('estatus_recover_tests','estatus_recover_tests.id','=','recover_esquema_tests.cve_estatusrecovertest')
                      ->join('users','users.id','=','recover_esquema_tests.cve_user')
                      ->wherein('recover_esquema_tests.cve_esquema',$esq)
                      ->where('recover_esquema_tests.fecha',$request->cve_fecha)
                      ->withCasts(['fecha' => 'date:Y-m-d'])
                      ->first();
          if (is_null($testcheck)) {
              $request->merge(['testcheck' => 1]);
          }

          $dbtobit = DB::table('bases')->select('cve_tipo')->where('id',$request->cve_base)->get();
          $request->merge(['dbtobit' => $dbtobit[0]->cve_tipo]);
          $validated=\Validator::make($request->all(), [
             'cve_datacenter' => 'bail|required|max:1',
             'cve_base' => ['bail','required','max:2'],
             'dbtobit' => ['bail','required','max:2', Rule::notIn(['1','2','4','5'])],
             'cve_fecha' => 'bail|required|before:today',
             'testcheck' => 'bail|required|max:1',
             //'daysem' => ['bail','required','max:2', Rule::notIn(['0','1','2','3','4','5'])],
          ]);

          if ($validated->fails())
          {
           return response()->json(['errors'=>$validated->errors()->all()]);
          }elseif ($validated) {
              $esquemas = Esquema::select(
                  'esquemas.id as cve_esquema',
                  'esquemas.esquema',
                  'bases.base',
                  'backups.backup'
              )
              ->join('bases','bases.id','esquemas.cve_base')
              ->join('backups','backups.id','esquemas.cve_backup')
              //->where('esquemas.id',$request->cve_esquema)
              ->where('esquemas.cve_base',$request->cve_base)
              ->where('esquemas.cve_backup',$request->cve_backup) //backup diarío
              ->orderByRaw('dbms_random.value')
              ->take(1)
              ->get();

              $estatus_recover_tests=EstatusRecoverTest::select('id','estatusrecovert')->get();
              $backups=Backup::select('id','backup')->get();
              if ($request->name_tabla=='bdiaria' && isset($esquemas[0]) ) {
                $bitrecord = Esquema::find($esquemas[0]->cve_esquema)
                                    ->bdiarias()
                                    ->where('fecha',$request->cve_fecha)
                                    ->first();
                $bitrecord->table=$request->name_tabla;
              }elseif ($request->name_tabla=='bsemanal' &&  isset($esquemas[0])) {
                $bitrecord = Esquema::find($esquemas[0]->cve_esquema)
                                    ->bsemanales()
                                    ->where('fecha',$request->cve_fecha)
                                    ->first();
              $bitrecord->table=$request->name_tabla;
              }else {
                $bitrecord=null;
              }


              //dd($bitrecord);
              return [$esquemas,$estatus_recover_tests,$backups,$bitrecord];
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
      //$request->merge(['daysem'=> Carbon::parse($request->bitdate)->dayOfWeek]);
      $validated=\Validator::make($request->all(), [
          'bitdate' => 'bail|required|date',
          'selUsuario' => 'bail|required|integer',
          //'recovere_archivos' => 'bail|required',
          //'recovere_archivos.*' => 'bail|required|mimetypes:application/gzip|max: 512',
          'base.*' => 'bail|required',
          'observaciones' => 'bail|required',
          'cve_esquema.*' => 'bail|required|max:5',
          'esquema.*' => 'bail|required',
          'selEstadoBackup.*' => ['bail','required', 'max: 1', Rule::In(['1','2','3'])],
          //'daysem' => ['bail','required','max:1', Rule::NotIn(['0','1','2','3','4','5'])]

      ]);

      if ($validated->fails())
      {
       return response()->json(['errors'=>$validated->errors()->all()]);
      }elseif ($validated) {
        $h=date("Ymd_his");
        if ($request->recovere_archivos) {
          $logs = $request->file('recovere_archivos');
          $i=1;
          foreach ($logs as $log) {
              $nombre = str_replace(' ', '_', $request->base[0] . '-RECOVERTEST-' . str_replace('-', '', $request->bitdate ). '_' . $h .'-'.$i.'.tar.' . $log->getClientOriginalExtension());
              // $nombre = $request->base[0] . '-MANUAL-' . $request->fecha . '_' . $h .'.tar.' . $log->getClientOriginalExtension();
              $path = $log->storeAs('erecovert', $nombre);
              $urls[] = $nombre;
              $i++;
             }

        }elseif(is_null($request->recovere_archivos)) {
          $urls[]='';
        }

          DB::beginTransaction();
          try {

              for ($i=0; $i < $request->ndata ; $i++) {
                if ($request->selBackup[$i]==1) {
                  $request->merge(['cve_dbitrecord'=> [$i=>$request->cve_bitrecord[$i]]]);
                  $request->merge(['cve_sbitrecord'=> [$i=>'']]);

                }elseif ($request->selBackup[$i]==2) {
                  $request->merge(['cve_sbitrecord'=> [$i=>$request->cve_bitrecord[$i]]]);
                  $request->merge(['cve_dbitrecord'=> [$i=>'']]);

                }
                  $recovertest = new RecoverEsquemaTest;
                  $recovertest->fecha = $request->bitdate;
                  $recovertest->cve_backup = $request->selBackup[$i];
                  $recovertest->cve_esquema = $request->cve_esquema[$i];
                  $recovertest->cve_dbitrecord = $request->cve_dbitrecord[$i];
                  $recovertest->cve_sbitrecord = $request->cve_sbitrecord[$i];
                  $recovertest->cve_estatusrecovertest = $request->selEstadoBackup[$i];
                  $recovertest->observaciones = '/'.$h."->CREAR:\n".$request->observaciones."\n". '/' . $h."->FINCREAR\n \n";
                  $recovertest->archivos = json_encode($urls);
                  $recovertest->cve_user = Auth::user()->id;
                  //return $recovertest;
                  $recovertest->save();
              }
          DB::commit();
          } catch (\Exception $e) {
              DB::rollBack();
              return $e;
           }
          return [$recovertest->fecha];
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


      $recovertest = RecoverEsquemaTest::select('recover_esquema_tests.id','recover_esquema_tests.fecha','recover_esquema_tests.cve_dbitrecord','recover_esquema_tests.cve_sbitrecord','backups.backup','esquemas.esquema','bases.base','estatus_recover_tests.estatusrecovert','recover_esquema_tests.archivos','recover_esquema_tests.observaciones','users.name')
                  ->join('esquemas','esquemas.id','=','recover_esquema_tests.cve_esquema')
                  ->join('bases','bases.id','=','esquemas.cve_base')
                  ->join('estatus_recover_tests','estatus_recover_tests.id','=','recover_esquema_tests.cve_estatusrecovertest')
                  ->join('users','users.id','=','recover_esquema_tests.cve_user')
                  ->join('backups','backups.id','=','recover_esquema_tests.cve_backup')
                  ->where('recover_esquema_tests.id',$id)
                  ->withCasts(['fecha' => 'date:Y-m-d'])
                  ->get();

      $estadoerecovertest = DB::table('estatus_recover_tests')->select('id','estatusrecovert')->get();
//dd($recovertest,$estadoerecovertest);
      return [$recovertest,$estadoerecovertest];
    }

    public function createe(Request $request)
    {
      $request->merge(['daysem'=> Carbon::parse($request->cve_fecha)->dayOfWeek]);
      if ($request->daysem>=1 && $request->daysem<=5 ) {
        $validated=\Validator::make($request->all(), [
           'cve_datacenter' => 'bail|required|max:1',
           'cve_base' => ['bail','required','max:2'],
           'cve_fecha' => 'bail|required|before:today',
           'cve_backup' => ['bail','required','max:1', Rule::In(['1'])],
           'daysem' => ['bail','required','max:1', Rule::notIn(['0','6'])],
        ]);
      }elseif ($request->daysem==6) {
        $validated=\Validator::make($request->all(), [
           'cve_datacenter' => 'bail|required|max:1',
           'cve_base' => ['bail','required','max:2'],
           'cve_fecha' => 'bail|required|before:today',
           'cve_backup' => ['bail','required','max:1', Rule::In(['2'])],
           'daysem' => ['bail','required','max:1', Rule::notIn(['0','1','2','3','4','5'])],
        ]);
      }elseif ($request->daysem==0) {
        $validated=\Validator::make($request->all(), [
           'cve_datacenter' => 'bail|required|max:1',
           'cve_base' => ['bail','required','max:2'],
           'cve_fecha' => 'bail|required|before:today',
           //'cve_backup' => ['bail','required','max:1', Rule::In(['1','2'])],
           'daysem' => ['bail','required','max:1', Rule::notIn(['0'])],
        ]);
      }

      if ($validated->fails()) {
          return response()->json(['errors'=>$validated->errors()->all()]);
      }elseif ($validated) {
          if ($request->cve_backup==1) {
            $request->merge(['name_tabla' => 'bdiaria']);
          }elseif ($request->cve_backup==2) {
            $request->merge(['name_tabla' => 'bsemanal']);
          }
          $esq = DB::table('esquemas')->where('cve_base',$request->cve_base)->pluck('id');
          $testcheck = RecoverEsquemaTest::select('recover_esquema_tests.id','recover_esquema_tests.fecha','esquemas.esquema','bases.base','estatus_recover_tests.estatusrecovert','recover_esquema_tests.archivos','recover_esquema_tests.observaciones','users.name')
                      ->join('esquemas','esquemas.id','=','recover_esquema_tests.cve_esquema')
                      ->join('bases','bases.id','=','esquemas.cve_base')
                      ->join('estatus_recover_tests','estatus_recover_tests.id','=','recover_esquema_tests.cve_estatusrecovertest')
                      ->join('users','users.id','=','recover_esquema_tests.cve_user')
                      ->wherein('recover_esquema_tests.cve_esquema',$esq)
                      ->where('recover_esquema_tests.fecha',$request->cve_fecha)
                      ->withCasts(['fecha' => 'date:Y-m-d'])
                      ->first();
          if (is_null($testcheck)) {
              $request->merge(['testcheck' => 1]);
          }

          $dbtobit = DB::table('bases')->select('cve_tipo')->where('id',$request->cve_base)->get();
          $request->merge(['dbtobit' => $dbtobit[0]->cve_tipo]);
          $validated=\Validator::make($request->all(), [
             'cve_datacenter' => 'bail|required|max:1',
             'cve_base' => ['bail','required','max:2'],
             'dbtobit' => ['bail','required','max:2', Rule::notIn(['1','2','4','5'])],
             'cve_fecha' => 'bail|required|before:today',
             'testcheck' => 'bail|required|max:1',
             //'daysem' => ['bail','required','max:2', Rule::notIn(['0','1','2','3','4','5'])],
          ]);

          if ($validated->fails())
          {
           return response()->json(['errors'=>$validated->errors()->all()]);
          }elseif ($validated) {
              $esquemas = Esquema::select(
                  'esquemas.id as cve_esquema',
                  'esquemas.esquema',
                  'bases.base',
                  'backups.backup'
              )
              ->join('bases','bases.id','esquemas.cve_base')
              ->join('backups','backups.id','esquemas.cve_backup')
              //->where('esquemas.id',$request->cve_esquema)
              ->where('esquemas.cve_base',$request->cve_base)
              ->where('esquemas.cve_backup',$request->cve_backup) //backup diarío
              ->orderByRaw('dbms_random.value')
              ->take(1)
              ->get();

              $estatus_recover_tests=EstatusRecoverTest::select('id','estatusrecovert')->get();
              $backups=Backup::select('id','backup')->get();
              if ($request->name_tabla=='bdiaria' && isset($esquemas[0]) ) {
                $bitrecord = Esquema::find($esquemas[0]->cve_esquema)
                                    ->bdiarias()
                                    ->where('fecha',$request->cve_fecha)
                                    ->first();
                $bitrecord->table=$request->name_tabla;
              }elseif ($request->name_tabla=='bsemanal' &&  isset($esquemas[0])) {
                $bitrecord = Esquema::find($esquemas[0]->cve_esquema)
                                    ->bsemanales()
                                    ->where('fecha',$request->cve_fecha)
                                    ->first();
              $bitrecord->table=$request->name_tabla;
              }else {
                $bitrecord=null;
              }


              //dd($bitrecord);
              return [$esquemas,$estatus_recover_tests,$backups,$bitrecord];
          }
      }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RecoverEsquemaTest  $recoverEsquemaTest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecoverEsquemaTest $recoverEsquemaTest)
    {
      //jkhgthn-.  dd($request);

        $validated=\Validator::make($request->all(), [
           'id' => 'bail|required',
           'base' => 'bail|required',
           'erecover_archivos.*' => 'mimetypes:application/gzip|max: 512',
           'cve_estatusrecovertest' => 'bail|required|max:1',
           'observaciones' => 'bail|required|max:300',
        ]);

        if ($validated->fails())
        {
         return response()->json(['errors'=>$validated->errors()->all()]);
        }elseif ($validated) {
        $recovertest = RecoverEsquemaTest::FindOrFail($request->id);
        $urls=json_decode($recovertest->archivos);
        $h=date("Ymd_his");
        if ($request->file('erecover_archivos')) {
            $logs = $request->file('erecover_archivos');
            $i=1;
            foreach ($logs as $log) {
                $nombre = str_replace(' ', '_', $request->base . '-' . $request->esquema. '-RECOVERTEST' . str_replace('-', '', $request->fecha ) . '-' . $h .'-'.$i.'.tar.' . $log->getClientOriginalExtension());
                 //$nombre = $request->base . '_' . $request->esquema . '_' . $request->fecha . '_' . $h .'.tar.' . $log->getClientOriginalExtension();
                 $path = $log->storeAs('erecovert', $nombre);
                 $urls[] = $nombre;
                 $i++;
               }

        }


            DB::beginTransaction();
            try {
                $recovertest->cve_estatusrecovertest = $request->cve_estatusrecovertest;
                $recovertest->observaciones = $recovertest->observaciones. '/'. $h."->EDITAR:\n".$request->observaciones."\n". '/' .$h."->FINEDITAR\n \n";
                $recovertest->archivos = json_encode($urls);
                $recovertest->push();
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return $e;
             }

       }


        return $recovertest;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RecoverEsquemaTest  $recoverEsquemaTest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //dd($request);
        $tesdelete = RecoverEsquemaTest::where('id',$request->id)->delete();
        //dd($tesdelete);
        return $tesdelete;
    }
}
