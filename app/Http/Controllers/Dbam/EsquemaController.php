<?php

namespace App\Http\Controllers\Dbam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Esquema;
use App\Models\Datacenter;
use Illuminate\Support\Facades\Crypt;
use DB;
use Auth;


class EsquemaController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware(['role_or_permission:Administrador de Base de Datos|DBA Junior|admin|adming']);
    }
    public function home()
    {
        $datacenters = Datacenter::pluck('datacenter','id');
        return View('dbam.esquema',compact('datacenters'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $user = Auth::user();
      if (is_null($request->cve_datacenter) && is_null($request->cve_base) ) {

        $listadoEsquemas = Esquema::select('esquemas.id','esquemas.esquema','users.name','bases.base','dependencias.nombre','programas.programa','backups.backup as respaldo','tipos.tipo','estadoesquemas.estadoesquema','esquemas.pwd','esquemas.observaciones')
          ->join('users','users.id','=','esquemas.cve_usuario')
          ->join('bases','bases.id','=','esquemas.cve_base')
          ->join('dependencias','dependencias.cve_dependencia','=','esquemas.cve_dependencia')
          ->join('programas','programas.cve_programa','=','esquemas.cve_programa')
          ->join('backups','backups.id','=','esquemas.cve_backup')
          ->join('tipos','tipos.id','=','esquemas.cve_tipo')
          ->join('estadoesquemas','estadoesquemas.id','=','esquemas.cve_estadoesquema')
          ->get();
      }elseif (isset($request->cve_datacenter) && is_null($request->cve_base) ) {

        $dbs = DB::table('bases')->where('cve_datacenter',$request->cve_datacenter)->pluck('id');

        $listadoEsquemas = Esquema::select('esquemas.id','esquemas.esquema','users.name','bases.base','dependencias.nombre','programas.programa','backups.backup as respaldo','tipos.tipo','estadoesquemas.estadoesquema','esquemas.pwd','esquemas.observaciones')
          ->join('users','users.id','=','esquemas.cve_usuario')
          ->join('bases','bases.id','=','esquemas.cve_base')
          ->join('dependencias','dependencias.cve_dependencia','=','esquemas.cve_dependencia')
          ->join('programas','programas.cve_programa','=','esquemas.cve_programa')
          ->join('backups','backups.id','=','esquemas.cve_backup')
          ->join('tipos','tipos.id','=','esquemas.cve_tipo')
          ->join('estadoesquemas','estadoesquemas.id','=','esquemas.cve_estadoesquema')
          ->wherein('esquemas.cve_base',$dbs)
          ->get();

      }elseif (isset($request->cve_datacenter) && isset($request->cve_base) ) {


        $listadoEsquemas = Esquema::select('esquemas.id','esquemas.esquema','users.name','bases.base','dependencias.nombre','programas.programa','backups.backup as respaldo','tipos.tipo','estadoesquemas.estadoesquema','esquemas.pwd','esquemas.observaciones')
          ->join('users','users.id','=','esquemas.cve_usuario')
          ->join('bases','bases.id','=','esquemas.cve_base')
          ->join('dependencias','dependencias.cve_dependencia','=','esquemas.cve_dependencia')
          ->join('programas','programas.cve_programa','=','esquemas.cve_programa')
          ->join('backups','backups.id','=','esquemas.cve_backup')
          ->join('tipos','tipos.id','=','esquemas.cve_tipo')
          ->join('estadoesquemas','estadoesquemas.id','=','esquemas.cve_estadoesquema')
          ->where('esquemas.cve_base',$request->cve_base)
          ->get();
      }



      $totalEsquemas = $listadoEsquemas->count();

      if ($user->hasRole(['Administrador de Base de Datos','God'])) {

              for ($i=0; $i <= $totalEsquemas-1 ; $i++) {
                try {
                  $decrypted = Crypt::decryptString($listadoEsquemas[$i]->pwd);
                  $listadoEsquemas[$i]->pwd = $decrypted;
                  } catch (DecryptException $e) {
                      //
                  }
              }
      }else {
        for ($i=0; $i <= $totalEsquemas-1 ; $i++) {
          try {
            $listadoEsquemas[$i]->pwd = 'PROTEGIDO';
            } catch (DecryptException $e) {
                //
            }
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
      $users = DB::table('users')->select('id','name')->orderBy('name','asc')->get();
      $bases = DB::table('bases')->select('id','base')->orderBy('base','asc')->get();
      $dependencias = DB::table('dependencias')->select('cve_dependencia','nombre')->orderBy('nombre','asc')->get();
      $programas = DB::table('programas')->select('cve_programa','programa')->orderBy('programa','asc')->get();
      $backups = DB::table('backups')->select('id','backup')->get();
      $tipos = DB::table('tipos')->select('id','tipo')->get();
      $estadoesquemas = DB::table('estadoesquemas')->select('id','estadoesquema')->get();


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
      $user = Auth::user();
      if ($user->hasRole(['God','Administrador de Base de Datos','DBA Junior'])) {
        $validated=\Validator::make($request->all(), [
             //'empr_nombre' => 'bail|required|',
             'esquema' => 'bail|required|max:50',
             //'empeval_fotos.*.file' => 'required|mimes:jpeg,jpg,png|max: 20000',
             'cve_usuario' => 'bail|required|max:2',
             'cve_base' => 'bail|required|max:2',
             'cve_tipo' => 'bail|required|max:2',
             'cve_dependencia' => 'bail|required|max:10',
             'cve_programa' => 'bail|required|max:8',
             'cve_backup' => 'bail|required|max:1',
             'cve_estadoesquema' => 'bail|required|max:2',
             'observaciones' => 'bail|required|max:300',

         ]);
           if ($validated->fails())
           {
             return response()->json(['errors'=>$validated->errors()->all()]);
           }
           if ($validated) {

             if (isset($request->pwd)) {
                $encrypted = Crypt::encryptString($request->pwd);
             }else{
                $encrypted = Crypt::encryptString('');
             }

             DB::beginTransaction();
             try {
              $esquema = Esquema::create([
              'esquema' => $request->esquema,
              'cve_usuario' => $request->cve_usuario,
              'cve_base' => $request->cve_base,
              'cve_tipo' => $request->cve_tipo,
              'cve_dependencia'=> $request->cve_dependencia,
              'cve_programa'=> $request->cve_programa,
              'cve_backup' => $request->cve_backup,
              'cve_estadoesquema' => $request->cve_estadoesquema,
              'observaciones' => $request->observaciones,
              'pwd' => $encrypted,
                ]);
              DB::commit();
             } catch (\Exception $e) {
               DB::rollBack();
               return $e;
             }

           }
        return $esquema;
      }else {
        return abort(403);
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
      $user = Auth::user();
      $esquema = Esquema::select('esquemas.id','esquemas.esquema','users.name','bases.base','dependencias.nombre','programas.programa','backups.backup as respaldo','tipos.tipo','estadoesquemas.estadoesquema','esquemas.pwd','esquemas.observaciones')
      ->join('users','users.id','=','esquemas.cve_usuario')
      ->join('bases','bases.id','=','esquemas.cve_base')
      ->join('dependencias','dependencias.cve_dependencia','=','esquemas.cve_dependencia')
      ->join('programas','programas.cve_programa','=','esquemas.cve_programa')
      ->join('backups','backups.id','=','esquemas.cve_backup')
      ->join('tipos','tipos.id','=','esquemas.cve_tipo')
      ->join('estadoesquemas','estadoesquemas.id','=','esquemas.cve_estadoesquema')
      ->where('esquemas.id','=',$id)
      ->get();
      if ( $user->hasRole(['God','Administrador de Base de Datos']) ) {
        try {
          $decrypted =  Crypt::decryptString($esquema[0]->pwd);
          $esquema[0]->pwd =  $decrypted;
          } catch ( DecryptException $e) {
              //no hagaw nada
          }
      }else {
        $esquema[0]->pwd = 'Ds#4s&M8XFw3h7';
      }



      $users = DB::table('users')->select('id','name')->orderBy('name','asc')->get();
      $bases = DB::table('bases')->select('id','base')->orderBy('base','asc')->get();
      $dependencias = DB::table('dependencias')->select('cve_dependencia','nombre')->orderBy('nombre','asc')->get();
      $programas = DB::table('programas')->select('cve_programa','programa')->orderBy('programa','asc')->get();
      $backups = DB::table('backups')->select('id','backup')->get();
      $tipos = DB::table('tipos')->select('id','tipo')->get();
      $estadoesquemas = DB::table('estadoesquemas')->select('id','estadoesquema')->get();


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
           'cve_usuario' => 'bail|required|max:2',
           'cve_base' => 'bail|required|max:2',
           'cve_tipo' => 'bail|required|max:2',
           'cve_dependencia' => 'bail|required|max:10',
           'cve_programa' => 'bail|required|max:8',
           'cve_backup' => 'bail|required|max:1',
           'cve_estadoesquema' => 'bail|required|max:2',
           'observaciones' => 'bail|required|max:300',

       ]);
       if ($validated->fails())
       {
         return response()->json(['errors'=>$validated->errors()->all()]);
       }
       if ($validated) {
         DB::beginTransaction();
         try {
          $esquema = Esquema::FindOrFail($request->id);
          $esquema->esquema = $request->esquema;
          $esquema->cve_usuario = $request->cve_usuario;
          $esquema->cve_base = $request->cve_base;
          $esquema->cve_tipo = $request->cve_tipo;
          $esquema->cve_dependencia = $request->cve_dependencia;
          $esquema->cve_programa = $request->cve_programa;
          $esquema->cve_backup = $request->cve_backup;
          $esquema->cve_estadoesquema = $request->cve_estadoesquema;
          $esquema->observaciones = $request->observaciones;
          if (isset($request->pwd)) {
            $esquema->pwd = Crypt::encryptString($request->pwd);
          }
          $esquema->push();
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

        public function esquemabydb($idbase)
    {

        $esquemas = Esquema::select('esquema','id')
          ->where('cve_base',$idbase)
          ->orderBy('esquema','asc')
          ->get();

        return $esquemas;
    }
}
