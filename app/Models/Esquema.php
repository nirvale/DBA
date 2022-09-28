<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Esquema extends Model
{
    use HasFactory;
    protected $fillable = [
        'ESQUEMA',
        'CVE_BASE',
        'CVE_USUARIO',
        'CVE_DEPENDENCIA',
        'CVE_PROGRAMA',
        'CVE_BACKUP',
        'CVE_TIPO',
        'CVE_ESTADOESQUEMA',
        'PWD',
        'OBSERVACIONES',
    ];
}
