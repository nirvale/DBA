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
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '229000000', 'NOMBRE'  => 'SECRETARIA DE OBRA PUBLICA']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '228000000', 'NOMBRE'  => 'SECRETARIA DE CULTURA']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '201000000', 'NOMBRE'  => 'GUBERNATURA']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '202000000', 'NOMBRE'  => 'SECRETARIA GENERAL DE GOBIERNO']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '201B00000', 'NOMBRE'  => 'DIFEM']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '207000000', 'NOMBRE'  => 'SECRETARIA DE DESARROLLO AGROPECUARIO']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '208000000', 'NOMBRE'  => 'SECRETARIA DE DESARROLLO ECONOMICO']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '206000000', 'NOMBRE'  => 'SECRETARIA DEL AGUA Y OBRA PUBLICA ']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '215000000', 'NOMBRE'  => 'SECRETARIA DE DESARROLLO SOCIAL']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '205000000', 'NOMBRE'  => 'SECRETARIA DE EDUCACION']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '210000000', 'NOMBRE'  => 'SECRETARIA DE LA CONTRALORIA']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '211000000', 'NOMBRE'  => 'SECRETARIA DE COMUNICACIONES']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '203000000', 'NOMBRE'  => 'SECRETARIA DE FINANZAS']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '213000000', 'NOMBRE'  => 'PROCURADURIA GENERAL DE JUSTICIA']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '214000000', 'NOMBRE'  => 'COORDINACION GENERAL DE COMUNICACION SOCIAL']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '227000000', 'NOMBRE'  => 'SECRETARIA DE JUSTICIA Y DERECHOS HUMANOS']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '216000000', 'NOMBRE'  => 'SECRETARIA DE DESARROLLO METROPOLITANO']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '217000000', 'NOMBRE'  => 'SECRETARIA DE SALUD']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '219000000', 'NOMBRE'  => 'SECRETARIA TECNICA DEL GABINETE']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '223000000', 'NOMBRE'  => 'SECRETARIA DE MOVILIDAD']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '224000000', 'NOMBRE'  => 'SECRETARIA DE DESARROLLO URBANO Y METROPOLITANO ']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '225000000', 'NOMBRE'  => 'SECRETARIA DE TURISMO ']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '999999999', 'NOMBRE'  => 'GOBIERNO FEDERAL']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '226000000', 'NOMBRE'  => 'SECRETARIA DE SEGURIDAD CIUDADANA']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '1111111111', 'NOMBRE'  => 'COORDINACION DE IMAGEN INSTITUCIONAL']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '202B00000', 'NOMBRE'  => 'CONSEJO ESTATAL DE POBLACION']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '203B00000', 'NOMBRE'  => 'INSTITUTO DE INFORMACION E INVESTIGACION GEOGRAFICA, ESTADISTICA Y CATASTRAL DEL ESTADO DE MEXICO']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '203700000', 'NOMBRE'  => 'COORDINACION DE GESTION GUBERNAMENTAL']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '212000000', 'NOMBRE'  => 'SECRETARIA DEL MEDIO AMBIENTE']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '22700000L', 'NOMBRE'  => 'SECRETARIA DE LA MUJER']);
      $dependencia = Dependencia::create (['CVE_DEPENDENCIA' => '204000000', 'NOMBRE'  => 'SECRETARIA DEL TRABAJO ']);
    }
}
