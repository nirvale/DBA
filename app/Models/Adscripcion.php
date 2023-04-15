<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adscripcion extends Model
{
    use HasFactory;
    protected $table = 'adscripciones';
    protected $fillable = [
        'cve_usuario',
        'cve_oficina',
        'cve_estado',
    ];
}
