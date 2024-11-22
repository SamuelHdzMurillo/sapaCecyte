<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProyectHasArea extends Model
{
    protected $fillable = [
        'idArea',
        
        'idProyecto'
    ];
}
