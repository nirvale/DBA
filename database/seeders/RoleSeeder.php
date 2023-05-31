<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
      //roles
      $r_god = Role::create([ 'guard_name' => 'web' , 'name' => 'God']);
      $r_admin = Role::create([ 'guard_name' => 'web' , 'name'=>'Administrador']);
      $r_invitado = Role::create([ 'guard_name' => 'web' , 'name'=>'Invitado']);
      $r_dbas = Role::create([ 'guard_name' => 'web' , 'name'=>'Administrador de Base de Datos']);
      $r_dbaj = Role::create([ 'guard_name' => 'web' , 'name'=>'DBA Junior']);
      $r_da = Role::create([ 'guard_name' => 'web' , 'name'=>'Director de Área']);
      $r_dg = Role::create([ 'guard_name' => 'web' , 'name'=>'Director General']);
      $r_developer = Role::create([ 'guard_name' => 'web' , 'name'=>'Desarrollador']);
      $r_ob = Role::create([ 'guard_name' => 'web' , 'name'=>'Operador de Backup']);
      $r_bitacora = Role::create([ 'guard_name' => 'web' , 'name'=>'Operador']);
      $r_ma = Role::create([ 'guard_name' => 'web' , 'name'=>'Mesa de Ayuda']);
      $r_oc = Role::create([ 'guard_name' => 'web' , 'name'=>'Operador Catálogos']);

      //permisos
      Permission::create([ 'guard_name' => 'web' , 'name' => 'adming'])->syncRoles($r_god);
      Permission::create([ 'guard_name' => 'web' , 'name' => 'admin'])->syncRoles($r_admin,$r_god);
      Permission::create([ 'guard_name' => 'web' , 'name' => 'imprimir_bitacora'])->syncRoles($r_god,$r_admin,$r_dbas,$r_dbaj,$r_da,$r_dg,$r_ob,$r_bitacora);
      Permission::create([ 'guard_name' => 'web' , 'name' => 'ver_bitacora'])->syncRoles($r_god,$r_admin,$r_dbas,$r_dbaj,$r_da,$r_dg,$r_ob,$r_bitacora);
      Permission::create([ 'guard_name' => 'web' , 'name' => 'editar_bitacora'])->syncRoles($r_god,$r_dbas,$r_dbaj,$r_ob);
      Permission::create([ 'guard_name' => 'web' , 'name' => 'crear_bitacora'])->syncRoles($r_god,$r_dbas,$r_dbaj,$r_ob);
      Permission::create([ 'guard_name' => 'web' , 'name' => 'ver_esquema'])->syncRoles($r_god,$r_admin,$r_dbas,$r_dbaj);
      Permission::create([ 'guard_name' => 'web' , 'name' => 'imiprimir_esquema'])->syncRoles($r_god,$r_admin,$r_dbas,$r_dbaj);
      Permission::create([ 'guard_name' => 'web' , 'name' => 'editar_esquema'])->syncRoles($r_god,$r_dbas,$r_dbaj);
      Permission::create([ 'guard_name' => 'web' , 'name' => 'crear_esquema'])->syncRoles($r_god,$r_dbas,$r_dbaj);
      Permission::create([ 'guard_name' => 'web' , 'name' => 'eliminar_esquema'])->syncRoles($r_god,$r_dbas,$r_dbaj);
      Permission::create([ 'guard_name' => 'web' , 'name' => 'infraestructura'])->syncRoles($r_god,$r_admin,$r_dbas);
      Permission::create([ 'guard_name' => 'web' , 'name' => 'app'])->syncRoles($r_god,$r_admin,$r_dbas,$r_dbaj);
      Permission::create([ 'guard_name' => 'web' , 'name' => 'developer'])->syncRoles($r_god,$r_admin,$r_developer);
      Permission::create([ 'guard_name' => 'web' , 'name' => 'ver_pwd'])->syncRoles($r_god,$r_dbas,$r_dbaj);
      Permission::create([ 'guard_name' => 'web' , 'name' => 'down_logs'])->syncRoles($r_god,$r_dbas,$r_dbaj);
      Permission::create([ 'guard_name' => 'web' , 'name' => 'modusers'])->syncRoles($r_god,$r_admin,$r_dbas,);
      Permission::create([ 'guard_name' => 'web' , 'name' => 'asig_area'])->syncRoles($r_god,$r_admin,$r_dbas,$r_ma);
      Permission::create([ 'guard_name' => 'web' , 'name' => 'ver_catalogos'])->syncRoles($r_god,$r_admin,$r_oc,$r_dbas,$r_dbaj);
      Permission::create([ 'guard_name' => 'web' , 'name' => 'imiprimir_catalogos'])->syncRoles($r_god,$r_admin,$r_oc,$r_dbas,$r_dbaj);
      Permission::create([ 'guard_name' => 'web' , 'name' => 'editar_catalogos'])->syncRoles($r_god,$r_oc,$r_dbas,$r_dbaj);
      Permission::create([ 'guard_name' => 'web' , 'name' => 'crear_catalogos'])->syncRoles($r_god,$r_oc,$r_dbas,$r_dbaj);
      Permission::create([ 'guard_name' => 'web' , 'name' => 'eliminar_catalogos'])->syncRoles($r_god,$r_oc,$r_dbas,$r_dbaj);
    }
}
