<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oficina extends Model
{
    use HasFactory;
    protected $primaryKey ='CVE_OFICINA';
    public $incrementing = false;
    //EN CASO DE QUE LA LLAVE NO SEA NÚMERICA
  //  protected $keyType = 'string';
    protected $fillable = [
        'CVE_OFICINA',
        'OFICINA',
    ];
}
