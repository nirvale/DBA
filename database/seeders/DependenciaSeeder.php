<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dependencia;

class DependenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $dependencia = Dependencia::create (['cve_dependencia' => '229000000', 'nombre'  => 'SECRETARIA DE OBRA PUBLICA']);
      $dependencia = Dependencia::create (['cve_dependencia' => '228000000', 'nombre'  => 'SECRETARIA DE CULTURA']);
      $dependencia = Dependencia::create (['cve_dependencia' => '201000000', 'nombre'  => 'GUBERNATURA']);
      $dependencia = Dependencia::create (['cve_dependencia' => '202000000', 'nombre'  => 'SECRETARIA GENERAL DE GOBIERNO']);
      $dependencia = Dependencia::create (['cve_dependencia' => '201B00000', 'nombre'  => 'DIFEM']);
      $dependencia = Dependencia::create (['cve_dependencia' => '207000000', 'nombre'  => 'SECRETARIA DE DESARROLLO AGROPECUARIO']);
      $dependencia = Dependencia::create (['cve_dependencia' => '208000000', 'nombre'  => 'SECRETARIA DE DESARROLLO ECONOMICO']);
      $dependencia = Dependencia::create (['cve_dependencia' => '206000000', 'nombre'  => 'SECRETARIA DEL AGUA Y OBRA PUBLICA ']);
      $dependencia = Dependencia::create (['cve_dependencia' => '215000000', 'nombre'  => 'SECRETARIA DE DESARROLLO SOCIAL']);
      $dependencia = Dependencia::create (['cve_dependencia' => '205000000', 'nombre'  => 'SECRETARIA DE EDUCACION']);
      $dependencia = Dependencia::create (['cve_dependencia' => '210000000', 'nombre'  => 'SECRETARIA DE LA CONTRALORIA']);
      $dependencia = Dependencia::create (['cve_dependencia' => '211000000', 'nombre'  => 'SECRETARIA DE COMUNICACIONES']);
      $dependencia = Dependencia::create (['cve_dependencia' => '203000000', 'nombre'  => 'SECRETARIA DE FINANZAS']);
      $dependencia = Dependencia::create (['cve_dependencia' => '213000000', 'nombre'  => 'PROCURADURIA GENERAL DE JUSTICIA']);
      $dependencia = Dependencia::create (['cve_dependencia' => '214000000', 'nombre'  => 'COORDINACION GENERAL DE COMUNICACION SOCIAL']);
      $dependencia = Dependencia::create (['cve_dependencia' => '227000000', 'nombre'  => 'SECRETARIA DE JUSTICIA Y DERECHOS HUMANOS']);
      $dependencia = Dependencia::create (['cve_dependencia' => '216000000', 'nombre'  => 'SECRETARIA DE DESARROLLO METROPOLITANO']);
      $dependencia = Dependencia::create (['cve_dependencia' => '217000000', 'nombre'  => 'SECRETARIA DE SALUD']);
      $dependencia = Dependencia::create (['cve_dependencia' => '219000000', 'nombre'  => 'SECRETARIA TECNICA DEL GABINETE']);
      $dependencia = Dependencia::create (['cve_dependencia' => '223000000', 'nombre'  => 'SECRETARIA DE MOVILIDAD']);
      $dependencia = Dependencia::create (['cve_dependencia' => '224000000', 'nombre'  => 'SECRETARIA DE DESARROLLO URBANO Y METROPOLITANO ']);
      $dependencia = Dependencia::create (['cve_dependencia' => '225000000', 'nombre'  => 'SECRETARIA DE TURISMO ']);
      $dependencia = Dependencia::create (['cve_dependencia' => '999999999', 'nombre'  => 'GOBIERNO FEDERAL']);
      $dependencia = Dependencia::create (['cve_dependencia' => '226000000', 'nombre'  => 'SECRETARIA DE SEGURIDAD CIUDADANA']);
      $dependencia = Dependencia::create (['cve_dependencia' => '1111111111', 'nombre'  => 'COORDINACION DE IMAGEN INSTITUCIONAL']);
      $dependencia = Dependencia::create (['cve_dependencia' => '202B00000', 'nombre'  => 'CONSEJO ESTATAL DE POBLACION']);
      $dependencia = Dependencia::create (['cve_dependencia' => '203B00000', 'nombre'  => 'INSTITUTO DE INFORMACION E INVESTIGACION GEOGRAFICA, ESTADISTICA Y CATASTRAL DEL ESTADO DE MEXICO']);
      $dependencia = Dependencia::create (['cve_dependencia' => '203700000', 'nombre'  => 'COORDINACION DE GESTION GUBERNAMENTAL']);
      $dependencia = Dependencia::create (['cve_dependencia' => '212000000', 'nombre'  => 'SECRETARIA DEL MEDIO AMBIENTE']);
      $dependencia = Dependencia::create (['cve_dependencia' => '22700000L', 'nombre'  => 'SECRETARIA DE LA MUJER']);
      $dependencia = Dependencia::create (['cve_dependencia' => '204000000', 'nombre'  => 'SECRETARIA DEL TRABAJO ']);
    }
}
