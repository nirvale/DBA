<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Belongs;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Bdiaria extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'cve_esquema',
        'cve_estadobackup',
        'archivos',
        'observaciones',
    ];
    public function esquemas(): BelongsTo
    {
        return $this->belongsToMany(Esquema::class,'id');
    }
    public function recoveresquematest(): HasOne
    {
        return $this->hasOne(RecoverEsquemaTest::class,'id');
    }
}
