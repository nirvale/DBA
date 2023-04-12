<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bdiaria extends Model
{
    use HasFactory;

    protected $fillable = [
        'FECHA',
        'CVE_ESQUEMA',
        'CVE_ESTADOBACKUP',
        'ARCHIVOS',
        'OBSERVACIONES',
    ];
}
