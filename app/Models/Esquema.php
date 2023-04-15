<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Esquema extends Model
{
    use HasFactory;
    protected $fillable = [
        'esquema',
        'cve_base',
        'cve_usuario',
        'cve_dependencia',
        'cve_programa',
        'cve_backup',
        'cve_tipo',
        'cve_estadoesquema',
        'pwd',
        'observaciones',
    ];
}
