<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Oficina;
use App\Models\Estado;
use App\Models\Adscripcion;
use DB;
use Yajra\Datatables\Datatables;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\ModelHasRoles;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function __construct(Request $request)
    {
        $this->middleware(['permission:admin|adming']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      // $listadoUsuarios = DB::table('users')
      //   ->join('adscripciones','adscripciones.cve_usuario','=','users.id')
      //   ->join('oficinas','oficinas.cve_oficina','=','adscripciones.cve_oficina')
      //   ->join('estados','estados.cve_estado','=','adscripciones.cve_estado')
      //   ->join('model_has_roles','model_has_roles.model_id','=','users.id')
      //   ->join('roles','roles.id','=','model_has_roles.role_id')
      // //  ->where('empresas_evaluaciones.empeval_cantidad_espacios','<',-10000)
      //   ->select('users.id','users.name','users.email','estados.estado','oficinas.oficina','roles.name as perfil')
      //   ->get();

      $listadoUsuarios = User::select('users.id','users.name','users.email','estados.estado','oficinas.oficina','roles.name as perfil')
      ->join('adscripciones','adscripciones.cve_usuario','=','users.id')
      ->join('oficinas','oficinas.cve_oficina','=','adscripciones.cve_oficina')
      ->join('estados','estados.cve_estado','=','adscripciones.cve_estado')
      ->join('model_has_roles','model_has_roles.model_id','=','users.id')
      ->join('roles','roles.id','=','model_has_roles.role_id')
      ->get();
        if ($request->ajax()) {
          return datatables()->of($listadoUsuarios)
          ->addColumn('action', function($row){
              $actionBtn = '<a href="javascript:void(0)" id="editarusuario" class="text-success"><i class="fas fa-user-edit"></i></a>
                            <a href="javascript:void(0)" id="eliminarusuario" class="text-danger"><i class="fas fa-user-times"></i></a> '
              ;
            return $actionBtn;
            })
          ->rawColumns(['action'])
          // ->toJson()
          ->make(true)
        ;
        }

    }

    public function listausuarios()
    {
      return View('admin.usuario');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $estados = DB::table('estados')->get();
      $oficinas = Db::table('oficinas')->get();
      $roles = DB::table('roles')
        ->get(['id','name']);

      return [$estados, $oficinas, $roles];
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
           'nombre' => 'bail|required|max:50',
           //'empeval_fotos.*.file' => 'required|mimes:jpeg,jpg,png|max: 20000',
           'cve_oficina' => 'bail|required|max:1',
           'id_perfil' => 'bail|required|max:2',
           'cve_estado' => 'bail|required|max:1',
           'email' => 'bail|required|email:rfc,dns',
           'pwd' => 'bail|required|max:10',
       ]);
       if ($validated->fails())
       {
         return response()->json(['errors'=>$validated->errors()->all()]);
       }
       if ($validated) {
         DB::beginTransaction();
         try {

          $user = User::create([
              'name' => $request->nombre,
              'email' => $request->email,
              'password' => Hash::make($request->pwd)
          ])->roles()->sync($request->id_perfil);

          $newid = User::where('email',$request->email)->get('id');

          $adscripcion = Adscripcion::create([
            'cve_usuario' => $newid[0]->id,
            'cve_oficina' => $request->cve_oficina,
            'cve_estado'  => $request->cve_estado

          ]);
          DB::commit();
         } catch (\Exception $e) {
           DB::rollBack();
           return $e;
         }

       }
       return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $usuario = DB::table('users')
        ->join('adscripciones','adscripciones.cve_usuario','=','users.id')
        ->join('oficinas','oficinas.cve_oficina','=','adscripciones.cve_oficina')
        ->join('estados','estados.cve_estado','=','adscripciones.cve_estado')
        ->join('model_has_roles','model_has_roles.model_id','=','users.id')
        ->join('roles','roles.id','=','model_has_roles.role_id')
        ->where('users.id','=',$id)
        ->select('users.id','users.name','users.email','estados.estado','oficinas.oficina','roles.name as perfil')
        ->get();

      $estados = DB::table('estados')->get(['cve_estado','estado']);
      $oficinas = Db::table('oficinas')->get(['cve_oficina','oficina']);
      $roles = DB::table('roles')
        ->get(['id','name']);

      return [$usuario, $estados, $oficinas, $roles];
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
      //return $request;
      $validated=\Validator::make($request->all(), [
           //'empr_nombre' => 'bail|required|',
           'nombre' => 'bail|required|max:50',
           //'empeval_fotos.*.file' => 'required|mimes:jpeg,jpg,png|max: 20000',
           'cve_oficina' => 'bail|required|max:1',
           'id_perfil' => 'bail|required|max:2',
           'cve_estado' => 'bail|required|max:1',
           'email' => 'bail|required|email:rfc,dns',
       ]);
       if ($validated->fails())
       {
         return response()->json(['errors'=>$validated->errors()->all()]);
       }
       if ($validated) {
         DB::beginTransaction();
         try {
          $usuario = User::find($request->id);
          $usuario->name = $request->nombre;
          $usuario->email = $request->email;
          if (isset($request->pwd)) {
            $usuario->password = Hash::make($request->pwd);
          }
          $usuario->save();

          $adscripcion = Adscripcion::where('cve_usuario',$request->id)->first();
          $adscripcion->cve_oficina = $request->cve_oficina;
          $adscripcion->cve_estado = $request->cve_estado;
          $adscripcion->save();

          $usuario->roles()->sync($request->id_perfil);
          DB::commit();
         } catch (\Exception $e) {
           DB::rollBack();
           return $e;
         }

       }
       return $usuario;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $adscripcion = Adscripcion::where('cve_usuario', $id)->firstOrFail();
        if (isset($usuario)) {
           DB::beginTransaction();
           try {
             $usuario->delete();
             // $adscripcion->delete();
             DB::commit();
           } catch (\Exception $e) {
             return $e;
           }

        }

        return $usuario;
    }
}
