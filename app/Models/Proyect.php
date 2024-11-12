<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyect extends Model
{
    protected $fillable = [
        'nombre_Proyecto',
        'descripcion_Proyecto',
        'presupuesto_Proyecto',
        'fechaInicio_Proyecto',
        'fechaFin_Proyecto',
        'comentario_Proyecto',
        'idAvance'
    ];

    // Modelo Proyecto.php
    public function avances()
    {
        return $this->hasMany(Avance::class, 'idProyecto');
    }

}
