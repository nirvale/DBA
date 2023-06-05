<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecoverEsquemaTest extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'fecha',
        'cve_backup',
        'cve_esquema',
        'cve_bitrecordd',
        'cve_bitrecords',
        'cve_estatusrecovertest',
        'archivos',
        'observaciones',
        'cve_user',
    ];

    public function bdiaria(): BelongsTo
    {
        return $this->belongsTo(Bdiaria::class,'id');
    }
    public function esquema(): BelongsTo
    {
        return $this->belongsTo(Esquema::class,'id');
    }
}
