<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Programa extends Model
{
    use HasFactory;
    protected $primaryKey ='cve_programa';
    public $incrementing = false;
    //EN CASO DE QUE LA LLAVE NO SEA NÚMERICA
    protected $keyType = 'string';
    protected $fillable = [
        'cve_dependencia',
        'cve_programa',
        'programa',
    ];
    public function esquemas(): HasMany
    {
        return $this->hasMany(Esquema::class,'cve_programa');
    }
}
