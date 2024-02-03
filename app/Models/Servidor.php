<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servidor extends Model
{
    use HasFactory;
    protected $table = 'servicores';
    protected $fillable = [
        'fecha',
        'cve_esquema',
        'cve_estadobackup',
        'archivos',
        'observaciones',
    ];
}
