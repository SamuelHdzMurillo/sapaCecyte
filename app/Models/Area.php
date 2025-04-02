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

    

    public function proyectos()
    {
        return $this->belongsToMany(Proyect::class, 'proyecto_has_area', 'idArea', 'idProyecto')
                    ->using(ProyectHasArea::class); // Indica el modelo de la tabla pivote
    }


    
}
