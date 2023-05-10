<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bmanual extends Model
{
    use HasFactory;
    protected $table = 'bmanuales';
    protected $fillable = [
        'fecha',
        'cve_esquema',
        'cve_estadobackup',
        'archivos',
        'observaciones',
      ];
}
