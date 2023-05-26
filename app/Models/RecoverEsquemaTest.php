<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecoverEsquemaTest extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'fecha',
        'cve_backup',
        'cve_esquema',
        'cve_estatusrecovertest',
        'archivos',
        'observaciones',
        'cve_user',
    ];
}
