<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'encargado_Area',
        'nombre_Area',
        'idProyecto',
    ];

    public function proyectos() {

        return $this->hasMany(\App\Models\Proyect::class, 'id');

    }

    
}
