<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avance extends Model
{
    protected $fillable = [
        'costo_Avance',
        'fecha_Avance',
        'descripcion_Avance',
        'evidencia_Avance',
        'idProyecto'
    ];

    // Modelo Avance.php
public function proyecto()
{
    return $this->belongsTo(Proyect::class, 'idProyecto');
}

}
