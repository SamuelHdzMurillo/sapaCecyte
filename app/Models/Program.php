<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    //

    protected $fillable = [
        'nombre_Programa',
        'anio_Programa',
        'presupuesto_Programa',
        'idProyecto'
    ];

    public function proyectos() {

        return $this->hasMany(\App\Models\Proyect::class, 'id');

    }
}
