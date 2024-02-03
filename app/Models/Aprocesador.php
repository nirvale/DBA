<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aprocesador extends Model
{
    use HasFactory;
    protected $table = 'aprocesadores';
    public function servidores(): BelongsTo
    {
        return $this->belongsToMany(Servidor::class);
    }
}
