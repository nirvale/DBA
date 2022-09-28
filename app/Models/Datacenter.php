<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datacenter extends Model
{
    use HasFactory;
    protected $fillable = [
        'DATACENTER',
        'TIPO',
        'DESC_DATACENTER',
    ];
}
