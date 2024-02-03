<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribucion extends Model
{
    use HasFactory;
    protected $table = 'distribuciones';
    public function oss(): BelongsTo
    {
        return $this->belongsToMany(Os::class);
    }
}
