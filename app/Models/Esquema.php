<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function programa(): BelongsTo
    {
        return $this->belongsTo(Programa::class,'cve_programa');
    }

    public function bdiarias(): HasMany
    {
        return $this->hasMany(Bdiaria::class,'cve_esquema');
    }

    public function bsemanales(): HasMany
    {
        return $this->hasMany(Bsemanal::class,'cve_esquema');
    }
    public function bmanual(): HasMany
    {
        return $this->hasMany(Bmanual::class,'cve_esquema');
    }
}
