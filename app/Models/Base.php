<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    use HasFactory;
    protected $fillable = [
        'BASE',
        'RDBMS',
        'VERSION',
        'OS',
        'OS_VERSION',
        'DATACENTER',
    ];
}
