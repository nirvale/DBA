<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Esquema;
use Illuminate\Support\Facades\Crypt;
use DB;

class EsquemaController extends Controller
{
  public function __construct(Request $request)
    {
        $this->middleware(['permission:admin|adming|dba|esquema']);
    }
    public function home()
    {
        return View('admin.esquema');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $listadoEsquemas = Esquema::select('esquemas.id','esquemas.ESQUEMA','users.name','bases.BASE','dependencias.NOMBRE','programas.PROGRAMA','backups.BACKUP as RESPALDO','tipos.TIPO','estadoesquemas.ESTADOESQUEMA','esquemas.PWD','esquemas.OBSERVACIONES')
      ->join('users','users.id','=','esquemas.CVE_USUARIO')
      ->join('bases','bases.id','=','esquemas.CVE_BASE')
      ->join('dependencias','dependencias.CVE_DEPENDENCIA','=','esquemas.CVE_DEPENDENCIA')
      ->join('programas','programas.CVE_PROGRAMA','=','esquemas.CVE_PROGRAMA')
      ->join('backups','backups.id','=','esquemas.CVE_BACKUP')
      ->join('tipos','tipos.id','=','esquemas.CVE_TIPO')
      ->join('estadoesquemas','estadoesquemas.id','=','esquemas.CVE_ESTADOESQUEMA')
      ->get();

      $totalEsquemas = $listadoEsquemas->count();

      for ($i=0; $i <= $totalEsquemas-1 ; $i++) {
        try {
          $decrypted = Crypt::decryptString($listadoEsquemas[$i]->PWD);
          $listadoEsquemas[$i]->PWD = $decrypted;
          } catch (DecryptException $e) {
              //
          }
      }

        if ($request->ajax()) {
          return datatables()->of($listadoEsquemas)
          ->addColumn('ACTION', function($row){
              $actionBtn = '<a href="javascript:void(0)" id="editaresquema" class="text-success"><i class="fas fa-user-edit"></i></a>
                            <a href="javascript:void(0)" id="eliminaresquema" class="text-danger"><i class="fas fa-user-times"></i></a> '
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
      $users = DB::table('users')->select('id','name')->get();
      $bases = DB::table('bases')->select('id','BASE')->get();
      $dependencias = DB::table('dependencias')->select('CVE_DEPENDENCIA','NOMBRE')->get();
      $programas = DB::table('programas')->select('CVE_PROGRAMA','PROGRAMA')->get();
      $backups = DB::table('backups')->select('id','BACKUP')->get();
      $tipos = DB::table('tipos')->select('id','TIPO')->get();
      $estadoesquemas = DB::table('estadoesquemas')->select('id','ESTADOESQUEMA')->get();


      return [$users,$bases,$dependencias,$programas,$backups,$tipos,$estadoesquemas];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validated=\Validator::make($request->all(), [
           //'empr_nombre' => 'bail|required|',
           'esquema' => 'bail|required|max:50',
           //'empeval_fotos.*.file' => 'required|mimes:jpeg,jpg,png|max: 20000',
           'CVE_USUARIO' => 'bail|required|max:2',
           'CVE_BASE' => 'bail|required|max:2',
           'CVE_TIPO' => 'bail|required|max:2',
           'CVE_DEPENDENCIA' => 'bail|required|max:10',
           'CVE_PROGRAMA' => 'bail|required|max:5',
           'CVE_BACKUP' => 'bail|required|max:1',
           'CVE_ESTADOESQUEMA' => 'bail|required|max:2',
           'OBSERVACIONES' => 'bail|required|max:300',

       ]);
       if ($validated->fails())
       {
         return response()->json(['errors'=>$validated->errors()->all()]);
       }
       if ($validated) {

         if (isset($request->PWD)) {
           $encrypted = Crypt::encryptString($request->PWD);
         }
         DB::beginTransaction();
         try {
          $esquema = ESQUEMA::create([
          'ESQUEMA' => $request->esquema,
          'CVE_USUARIO' => $request->CVE_USUARIO,
          'CVE_BASE' => $request->CVE_USUARIO,
          'CVE_TIPO' => $request->CVE_TIPO,
          'CVE_DEPENDENCIA'=> $request->CVE_DEPENDENCIA,
          'CVE_PROGRAMA'=> $request->CVE_PROGRAMA,
          'CVE_BACKUP' => $request->CVE_BACKUP,
          'CVE_ESTADOESQUEMA' => $request->CVE_ESTADOESQUEMA,
          'OBSERVACIONES' => $request->OBSERVACIONES,
          'PWD' => $encrypted,
            ]);
          DB::commit();
         } catch (\Exception $e) {
           DB::rollBack();
           return $e;
         }

       }
       return $esquema;
}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      $esquema = Esquema::select('esquemas.id','esquemas.ESQUEMA','users.name','bases.BASE','dependencias.NOMBRE','programas.PROGRAMA','backups.BACKUP as RESPALDO','tipos.TIPO','estadoesquemas.ESTADOESQUEMA','esquemas.PWD','esquemas.OBSERVACIONES')
      ->join('users','users.id','=','esquemas.CVE_USUARIO')
      ->join('bases','bases.id','=','esquemas.CVE_BASE')
      ->join('dependencias','dependencias.CVE_DEPENDENCIA','=','esquemas.CVE_DEPENDENCIA')
      ->join('programas','programas.CVE_PROGRAMA','=','esquemas.CVE_PROGRAMA')
      ->join('backups','backups.id','=','esquemas.CVE_BACKUP')
      ->join('tipos','tipos.id','=','esquemas.CVE_TIPO')
      ->join('estadoesquemas','estadoesquemas.id','=','esquemas.CVE_ESTADOESQUEMA')
      ->where('esquemas.id','=',$id)
      ->get();


      try {
        $decrypted = Crypt::decryptString($esquema[0]->PWD);
        $esquema[0]->PWD = $decrypted;
        } catch (DecryptException $e) {
            //
        }

      $users = DB::table('users')->select('id','name')->get();
      $bases = DB::table('bases')->select('id','BASE')->get();
      $dependencias = DB::table('dependencias')->select('CVE_DEPENDENCIA','NOMBRE')->get();
      $programas = DB::table('programas')->select('CVE_PROGRAMA','PROGRAMA')->get();
      $backups = DB::table('backups')->select('id','BACKUP')->get();
      $tipos = DB::table('tipos')->select('id','TIPO')->get();
      $estadoesquemas = DB::table('estadoesquemas')->select('id','ESTADOESQUEMA')->get();


      return [$esquema,$users,$bases,$dependencias,$programas,$backups,$tipos,$estadoesquemas];
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
           //'empr_nombre' => 'bail|required|',
           'esquema' => 'bail|required|max:50',
           //'empeval_fotos.*.file' => 'required|mimes:jpeg,jpg,png|max: 20000',
           'CVE_USUARIO' => 'bail|required|max:2',
           'CVE_BASE' => 'bail|required|max:2',
           'CVE_TIPO' => 'bail|required|max:2',
           'CVE_DEPENDENCIA' => 'bail|required|max:10',
           'CVE_PROGRAMA' => 'bail|required|max:5',
           'CVE_BACKUP' => 'bail|required|max:1',
           'CVE_ESTADOESQUEMA' => 'bail|required|max:2',
           'OBSERVACIONES' => 'bail|required|max:300',

       ]);
       if ($validated->fails())
       {
         return response()->json(['errors'=>$validated->errors()->all()]);
       }
       if ($validated) {
         DB::beginTransaction();
         try {
          $esquema = ESQUEMA::find($request->id);
          $esquema->esquema = $request->esquema;
          $esquema->CVE_USUARIO = $request->CVE_USUARIO;
          $esquema->CVE_BASE = $request->CVE_BASE;
          $esquema->CVE_TIPO = $request->CVE_TIPO;
          $esquema->CVE_DEPENDENCIA = $request->CVE_DEPENDENCIA;
          $esquema->CVE_PROGRAMA = $request->CVE_PROGRAMA;
          $esquema->CVE_BACKUP = $request->CVE_BACKUP;
          $esquema->CVE_ESTADOESQUEMA = $request->CVE_ESTADOESQUEMA;
          $esquema->OBSERVACIONES = $request->OBSERVACIONES;
          if (isset($request->PWD)) {
            $esquema->PWD = Crypt::encryptString($request->PWD);
          }
          $esquema->save();
          DB::commit();
         } catch (\Exception $e) {
           DB::rollBack();
           return $e;
         }

       }
       return $esquema;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $esquema = Esquema::find($id);
      if (isset($esquema)) {
         DB::beginTransaction();
         try {
           $esquema->delete();
           DB::commit();
         } catch (\Exception $e) {
           return $e;
         }

      }

      return $esquema;
    }
}
