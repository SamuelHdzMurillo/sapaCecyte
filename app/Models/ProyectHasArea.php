<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyectHasArea extends Model
{
    use HasFactory;

    protected $table = 'proyecto_has_area';  // Si el nombre de la tabla es diferente, asegúrate de definirlo aquí.

    protected $fillable = [
        'idArea',
        'idProyecto',
    ];
}
