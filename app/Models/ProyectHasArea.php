<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProyectHasArea extends Pivot
{
    protected $table = 'proyecto_has_area';  // Si el nombre de la tabla es diferente, asegúrate de definirlo aquí.

    protected $fillable = [
        'idArea',
        'idProyecto',
    ];
}
