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

    public function areas()
    {
        return $this->belongsToMany(Area::class, 'proyecto_has_area', 'idProyecto', 'idArea')
                    ->using(ProyectHasArea::class); // Indica el modelo de la tabla pivote
    }

    public function calcularPorcentajeAvance()
{
    $presupuestoTotal = $this->presupuesto_Proyecto;

    if ($presupuestoTotal <= 0) {
        return ['error' => 'El presupuesto del proyecto no es válido.'];
    }

    $resultados = [];
    $totalGastado = 0;

    foreach ($this->avances as $avance) {
        $costoAvance = $avance->costo_Avance;
        $porcentaje = ($costoAvance / $presupuestoTotal) * 100;
        $totalGastado += $costoAvance;

        $resultados[] = [
            'avance_id' => $avance->id,
            'descripcion' => $avance->descripcion_Avance,
            'costo' => $costoAvance,
            'porcentaje' => round($porcentaje, 2) . '%'
        ];
    }

    $porcentajeTotal = ($totalGastado / $presupuestoTotal) * 100;

    return [
        'avances' => $resultados,
        'total_gastado' => $totalGastado,
        'porcentaje_total' => round($porcentajeTotal, 2) . '%'
    ];
}




}
