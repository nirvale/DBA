<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;
    protected $primaryKey='CVE_ESTADO';
    protected $fillable = [
        'CVE_ESTADO',
        'ESTADO',
    ];
}
