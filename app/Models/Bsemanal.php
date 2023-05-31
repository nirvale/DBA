<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Bsemanal extends Model
{
    use HasFactory;
    protected $table = 'bsemanales';
    protected $fillable = [
        'fecha',
        'cve_esquema',
        'cve_estadobackup',
        'archivos',
        'observaciones',
    ];
    public function esquemas(): BelongsToMany
    {
        return $this->belongsToMany(Esquema::class);
    }
}
